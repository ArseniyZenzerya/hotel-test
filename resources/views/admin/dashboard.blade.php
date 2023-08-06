@extends('layout.app')
@section('title', 'Dashboard')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <div class="dashboard">
        <a href="{{route('admin.logout')}}">Log out</a>
        <a href="{{route('home')}}">Home</a>
        <h2>Додати бронь</h2>
        <div class="new-form">
            <form action="{{ route('add-book') }}" method="POST">
                @csrf
                <div class="inputs-block">
                    <input type="text" value="true" hidden name="admin_type">
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

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <section class="table-section">
            <table>
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Дата заїзду, з</th>
                    <th>Дата виїзду, до</th>
                    <th>Статус</th>
                    <th>Видалити бронювання</th>
                </tr>
                </thead>
                <tbody>
                <input type="text" hidden value="{{ csrf_token() }}" class="csrf">
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->email }}</td>
                        <td>{{ Illuminate\Support\Facades\Crypt::decryptString($book->tel) }}</td>
                        <td>{{ $book->check_in }}</td>
                        <td>{{ $book->check_out }}</td>
                        <td>
                            <select name="status" class="status" data-id="{{$book->id}}">
                                <option value="wait" {{ $book->status === 'wait' ? 'selected' : '' }}>В очікуванні</option>
                                <option value="active" {{ $book->status === 'active' ? 'selected' : '' }}>Успішно</option>
                                <option value="failure" {{ $book->status === 'failure' ? 'selected' : '' }}>Відхилено</option>
                            </select>
                        </td>
                        <td>
                            <a data-id="{{$book->id}}" href="#" class="delete">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.3388 2.87829H14.1776V2.19984C14.1776 0.986842 13.1908 0 11.9778 0H8.02217C6.80917 0 5.82233 0.986842 5.82233 2.19984V2.87829H1.66115C1.35276 2.87829 1.10605 3.125 1.10605 3.43339C1.10605 3.74178 1.35276 3.98849 1.66115 3.98849H2.66444V17.0312C2.66444 18.6678 3.99667 20 5.63319 20H14.3667C16.0033 20 17.3355 18.6678 17.3355 17.0312V3.98849H18.3388C18.6472 3.98849 18.8939 3.74178 18.8939 3.43339C18.8939 3.125 18.6472 2.87829 18.3388 2.87829ZM6.93253 2.19984C6.93253 1.59951 7.42184 1.1102 8.02217 1.1102H11.9778C12.5781 1.1102 13.0674 1.59951 13.0674 2.19984V2.87829H6.93253V2.19984ZM16.2253 17.0312C16.2253 18.0551 15.3906 18.8898 14.3667 18.8898H5.63319C4.60934 18.8898 3.77463 18.0551 3.77463 17.0312V3.98849H16.2294V17.0312H16.2253Z"
                                        fill="#AE8B70"/>
                                    <path
                                        d="M9.99992 16.8996C10.3083 16.8996 10.555 16.6529 10.555 16.3445V6.53369C10.555 6.2253 10.3083 5.97859 9.99992 5.97859C9.69153 5.97859 9.44482 6.2253 9.44482 6.53369V16.3404C9.44482 16.6488 9.69153 16.8996 9.99992 16.8996Z"
                                        fill="#AE8B70"/>
                                    <path
                                        d="M6.37749 16.287C6.68587 16.287 6.93258 16.0403 6.93258 15.7319V7.14226C6.93258 6.83387 6.68587 6.58716 6.37749 6.58716C6.0691 6.58716 5.82239 6.83387 5.82239 7.14226V15.7319C5.82239 16.0403 6.07321 16.287 6.37749 16.287Z"
                                        fill="#AE8B70"/>
                                    <path
                                        d="M13.6225 16.287C13.9309 16.287 14.1776 16.0403 14.1776 15.7319V7.14226C14.1776 6.83387 13.9309 6.58716 13.6225 6.58716C13.3141 6.58716 13.0674 6.83387 13.0674 7.14226V15.7319C13.0674 16.0403 13.3141 16.287 13.6225 16.287Z"
                                        fill="#AE8B70"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="pagination">
                {{ $books->links() }}
            </div>
        </section>
    </div>
@endsection
