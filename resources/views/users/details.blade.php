@extends('layouts.master')

@section('title')

    <h1>{{$title}}</h1>

@endsection

@section('content')

    <div>
        <h2>Nome:</h2>
        <h2></h2>
    </div>

    <div class=" col-md-9 col-lg-9 ">
        <table class="table table-user-information">
            <tbody>
            <tr>
                <td>Department:</td>
                <td>Programming</td>
            </tr>
            <tr>
                <td>Hire date:</td>
                <td>06/23/2013</td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>01/24/1988</td>
            </tr>

            <tr>
            <tr>
                <td>Gender</td>
                <td>Female</td>
            </tr>
            <tr>
                <td>Home Address</td>
                <td>Kathmandu,Nepal</td>
            </tr>
            <tr>
                <td>Email</td>
                <td><a href="mailto:info@support.com">info@support.com</a></td>
            </tr>
            <td>Phone Number</td>
            <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
            </td>

            </tr>

            </tbody>
        </table>

@endsection