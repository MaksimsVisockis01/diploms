<form action="{{ url()->current() }}" method="GET" class="mt-3">
    <div class="form-group">
        <label for="date_filter">Filter By</label>
        <select name="date_filter" id="date_filter" onchange="this.form.submit()">
            <option value="daily" {{ request('date_filter', 'daily') == 'daily' ? 'selected' : '' }}>Daily</option>
            <option value="weekly" {{ request('date_filter') == 'weekly' ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ request('date_filter') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="yearly" {{ request('date_filter') == 'yearly' ? 'selected' : '' }}>Yearly</option>
        </select>
    </div>
    <div class="form-group">
        <label for="date">Select Date</label>
        <input type="date" name="date" id="date" value="{{ request('date') }}" onchange="this.form.submit()">
    </div>
</form>
