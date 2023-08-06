@extends('layout.app')
@section('title', 'Hotel')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')
    @include('partials.header')
<section>
    <div class="center" id="form">
        <div class="text-center title big-text">
            <svg class="ellipse_main" width="598" height="250" viewBox="0 0 598 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M595.903 75.1105C598.507 90.6105 592.776 106.814 580.062 122.87C567.348 138.926 547.684 154.788 522.533 169.571C472.234 199.134 400.083 224.324 318.004 238.11C235.925 251.897 159.503 251.663 102.305 240.156C73.7043 234.402 49.937 225.835 32.6749 214.814C15.4129 203.793 4.70296 190.351 2.09944 174.851C-0.504074 159.351 5.22636 143.147 17.9404 127.091C30.6543 111.035 50.3182 95.1728 75.4695 80.3902C125.769 50.8269 197.92 25.6374 279.999 11.8508C362.078 -1.93591 438.5 -1.70201 495.698 9.80517C524.298 15.5591 548.066 24.1264 565.328 35.1475C582.59 46.1685 593.3 59.6104 595.903 75.1105Z" stroke="#AE8B70"/>
            </svg>
            <h1>ЗАБРОНЮЙТЕ <span>в Hotel logo</span><br>СВОЄ МІСЦЕ</h1>
        </div>
    </div>
    <div>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <form action="{{ route('add-book') }}" method="POST">
                @csrf
                <div class="inputs-block">
                    <div>
                        <label for="check-in">Дата заїзду</label>
                        <input type="text" name="check_in" id="check-in" readonly>
                        @error('check_in')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="check-out">Дата виїзду</label>
                        <input type="text" name="check_out" id="check-out" readonly>
                        @error('check_out')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="tel">Номер телефону</label>
                        <input type="tel" id="tel" pattern="\+380[0-9]{9}"  name="tel" placeholder="+380123456789">
                        @error('tel')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email">E-mail</label>
                        <input id="email" name="email" type="text" placeholder="test@test.com">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="center">
                    <input type="submit" class="button fill-button" value="Забронювати">
                </div>
            </form>


    </div>
</section>
<section class="info-booking">
    <div class="title sub-text">
        <svg class="ellipse_sub" width="359" height="162" viewBox="0 0 359 162" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M357.274 51.232C358.969 61.3225 355.678 71.8054 348.184 82.1455C340.687 92.4876 329.008 102.653 314.007 112.072C284.007 130.91 240.81 146.712 191.528 154.99C142.246 163.268 96.2571 162.446 61.7486 154.443C44.4932 150.442 30.1335 144.651 19.6696 137.325C9.20781 130.001 2.67272 121.169 0.977835 111.078C-0.717052 100.988 2.57366 90.5051 10.0685 80.1649C17.5647 69.8228 29.2443 59.6579 44.2454 50.2384C74.2456 31.4005 117.442 15.5981 166.724 7.32035C216.006 -0.95741 261.995 -0.135483 296.504 7.86699C313.759 11.8685 328.119 17.6596 338.583 24.985C349.044 32.309 355.579 41.1414 357.274 51.232Z" stroke="#AE8B70"/>
        </svg>
        <h1>ІСТОРІЯ<span>ваших</span></h1><h1>БРОНЮВАНЬ</h1>
    </div>
</section>
<section class="table-section">
    <input type="text" hidden value="{{ csrf_token() }}" class="csrf">
    <table>
        <thead>
        <tr>
            <th>Дата заїзду, з</th>
            <th>Дата виїзду, до</th>
            <th>Статус</th>
            <th>Видалити бронювання</th>
        </tr>
        </thead>
        <tbody>
        @include('partials.item-table', ['books'=>$books])
        </tbody>
    </table>
</section>
    @include('partials.footer')
@endsection
