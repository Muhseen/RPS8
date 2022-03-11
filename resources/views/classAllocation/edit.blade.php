@extends('layouts.admin')
@section('content')
<div class="container">
    <script defer src="{{asset('js/allocateClass.js')}} " type="text/javascript"></script>

    <form action="/allocateClass/{{$allocation->id}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group-sm">
            <label for="staffNo"><b>Staff Number</b></label>
            <input type="text" name="staffNo" class="form-control" value="{{$allocation->staffNo}}">
        </div>
        <div class="form-group-sm">
            <label for="staffName" class="control-label"><b>Staff Name</b></label>
            <input type="text" name="staffName" class="form-control" disbaled value="{{$allocation->staffName}}">
        </div>
        <label for=><b>Programme Type</b></label>
        <select name="progType" id="progType" class="form-control form-control-sm mb-4">
            <option value="regular">Regular</option>
            <option value="evening">Evening</option>
        </select>
        <label for=><b>Dept</b></label>
        <select name="dept" id="dept" class=" dept form-control form-control-sm mb-4">
            @foreach ($depts as $dept)
            <option value="{{$dept->DEPT_ID}}" {{$allocation->deptRel->DEPT_ID==$dept->DEPT_ID?"Selected":""}}>
                {{$dept->DEPARTMENT}}</option>

            @endforeach
        </select>
        <label for=><b>Programme Type</b></label>
        <select name="prog" id="prog" class="form-control form-control-sm mb-4">
            @foreach ($progs as $prog)
            <option value="{{$prog->PROGCODE}}" {{$prog->PROGCODE==$allocation->prog?"selected":""}}>
                {{$prog->PROGRAMME}}</option>
            @endforeach
        </select>

        <label for=><b>Session</b></label>
        <select name="session" class="form-control form-control-sm mb-4" value="{{$allocation->session}}">
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>
        <label for=><b>Semester</b></label>
        <select name="semester" class="form-control form-control-sm mb-4" value="{{$allocation->semester}}">
            <option value="1">First</option>
            <option value="2">Second</option>
            <option value="3">Third</option>
            <option value="4">Fourth</option>
        </select>
        <label for=><b>Course Code</b></label>
        <select name="courseCode" class="form-control form-control-sm mb-4" value="{{$allocation->courseCode}}">
            @foreach ($courses as $course)
            <option value="{{$course->code}}" {{$course->code==$allocation->courseCode?"selected":""}}>
                {{$course->code}}:{{$course->title}}</option>

            @endforeach
        </select>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input value="1" name="isLeadLec" type="checkbox" {{$allocation->isLeadLec==1?"checked":""}}
                    class="form-check-input">Set
                as lead lecturer for course
            </label>
        </div>

</div>
<div class="btn-group ml-5">
    <button type="submit" class="btn btn-primary">Update Record </button>
    <button class="btn btn-danger">Reset</button>
</div>
</form>
</div>
@endsection