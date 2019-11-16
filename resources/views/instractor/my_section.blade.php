@extends('instractor.instractor-sidebar')

@section('instructor-content')

<div class="card">
    <div class="card-header">Instractor</div>

    <div class="card-body">
        <div class="row">

            <div class="col-md-4" style="padding-left: 30px;padding-top: 8px;">

            </div>

            <div class="col-md-4">
                <p style="text-align:center;font-size: 30px;">{{$SectionData->section_name}}</p>
            </div>

            <div class="col-md-4">
                <a style="position: absolute;right: 20px;color: white;padding: 10px;background-color: #4ac5f2;" href="{{url('section/edit_section/'.$SectionData->sectionID)}}">Edit Section</a>
                <a style="cursor: pointer;position: absolute;right: 120px;color: white;padding: 10px;background-color: red;" data-toggle="modal" data-target="#myModal" >Delete Section</a>
            </div>
        </div>
        <table class="table table-bordered success" style="margin-top:10px;">
            <thead>
            <tr >
                <th><b>Student Name</b></th>
                <td><b> Student ID</b></td>
                <td><b> Status</b></td>
            </tr>
            @foreach($arrayStudentsName as $key => $ar)
                <tr >
                    <td>
                        @if($ar)
                            {{$ar->studentName}}
                        @else
                            <p style="color:red">Not registered yet</p>
                        @endif
                    </td>

                    <td>
                        @if($key)
                            {{$key}}
                        @endif
                    </td>
                    <td>
                        @if($ar)
                            registered
                        @else
                            <p style="color:red">Not registered yet</p>
                        @endif
                    </td>
                </tr>
            @endforeach

            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px;">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body" style="padding:15px;">
                <h2>Are you sure you want to delete the section?</h2>
                <a class="btn btn-danger" style="color:#fff;" href="{{url('section/deleteSection/'.$SectionData->sectionID)}}">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@endsection
