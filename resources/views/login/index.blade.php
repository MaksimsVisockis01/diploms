@extends('layouts.base')

@section('page.title')
    Login page
@endsection

@section('content')

     <section>
          <h1>Login</h1>
          <form action="{{ route('login.store') }}" method="POST">
              <div class="txt_field">
                  <input type="text" name="uid" required>
                  <span></span>
                  <label>Username</label>
              </div>
              <div class="txt_field">
                    <input type="password" name="pwd" required>
                        <span></span>
                        <label>Password</label>
              </div>
              <button id="loginButton" type="submit" name="submit">Login</button>
          </form>

     </section>
@endsection
