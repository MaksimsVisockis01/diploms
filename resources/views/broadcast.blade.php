@extends('layouts.base')

@section('page.title', 'Broadcasting')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Broadcasting Page</div>
                <div class="card-body">
                    <video id="localVideo" autoplay playsinline></video>
                    <video id="remoteVideo" autoplay playsinline></video>
                    <br>
                    @if(auth()->check() && (auth()->user()->teacher || auth()->user()->admin))
                    <button id="startBroadcastBtn" class="btn btn-primary">Start Broadcast</button>
                    @endif
                    <div id="broadcastControls" style="display: none;">
                        <button id="toggleCameraBtn" class="btn btn-secondary">Toggle Camera</button>
                        <button id="toggleMicBtn" class="btn btn-secondary">Toggle Microphone</button>
                        <button id="endBroadcastBtn" class="btn btn-danger">End Broadcast</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let localStream;
        let remoteStream;
        let pc;
        const socket = new WebSocket('ws://localhost:8080');

        socket.onmessage = event => {
            const data = JSON.parse(event.data);

            if (data.type === 'offer') {
                pc.setRemoteDescription(new RTCSessionDescription(data));
                pc.createAnswer()
                    .then(answer => pc.setLocalDescription(answer))
                    .then(() => socket.send(JSON.stringify(pc.localDescription)))
                    .catch(error => console.error('Error creating answer:', error));
            } else if (data.type === 'answer') {
                pc.setRemoteDescription(new RTCSessionDescription(data));
            } else if (data.type === 'candidate') {
                pc.addIceCandidate(new RTCIceCandidate(data.candidate));
            }
        };

        function startBroadcast() {
            const configuration = { iceServers: [{ urls: 'stun:stun.l.google.com:19302' }] };
            pc = new RTCPeerConnection(configuration);

            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then(stream => {
                    localStream = stream;
                    document.getElementById('localVideo').srcObject = localStream;
                    localStream.getTracks().forEach(track => pc.addTrack(track, localStream));
                })
                .catch(error => {
                    console.error('Error accessing media devices: ', error);
                });

            pc.ontrack = event => {
                remoteStream = event.streams[0];
                document.getElementById('remoteVideo').srcObject = remoteStream;
            };

            pc.onicecandidate = event => {
                if (event.candidate) {
                    socket.send(JSON.stringify({ type: 'candidate', candidate: event.candidate }));
                }
            };

            pc.createOffer()
                .then(offer => pc.setLocalDescription(offer))
                .then(() => socket.send(JSON.stringify(pc.localDescription)))
                .catch(error => {
                    console.error('Error creating offer: ', error);
                });
        }

        document.getElementById('startBroadcastBtn').addEventListener('click', function () {
            startBroadcast();
            document.getElementById('startBroadcastBtn').style.display = 'none';
            document.getElementById('broadcastControls').style.display = 'block';
        });

        document.getElementById('toggleCameraBtn').addEventListener('click', function () {
            localStream.getVideoTracks().forEach(track => {
                track.enabled = !track.enabled;
            });
        });

        document.getElementById('toggleMicBtn').addEventListener('click', function () {
            localStream.getAudioTracks().forEach(track => {
                track.enabled = !track.enabled;
            });
        });

        document.getElementById('endBroadcastBtn').addEventListener('click', function () {
            pc.close();
            localStream.getTracks().forEach(track => track.stop());
            document.getElementById('localVideo').srcObject = null;
            document.getElementById('remoteVideo').srcObject = null;
            document.getElementById('startBroadcastBtn').style.display = 'block';
            document.getElementById('broadcastControls').style.display = 'none';
        });
    });
</script>
@endsection
