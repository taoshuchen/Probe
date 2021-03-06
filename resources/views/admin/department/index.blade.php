<?php
/**
 * IDE Name: PhpStorm
 * Project : Probe
 * FileName: index.blade.php
 * Author  : Li Tao
 * DateTime: 2018-02-07 07:34:00
 */
?>

@extends('admin.index')

@section('main')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">department</th>
                <th scope="col">city</th>
                <th scope="col">province</th>
                <th scope="col">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#createPermission">
                        Create
                    </button>
                    <div class="modal fade" id="createPermission" tabindex="-1" role="dialog" aria-labelledby="createPermissionTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            @include('admin.department.create')
                        </div>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($departmentList as $department)
                <tr>
                    <th scope="row">{{ $department['id'] or 0 }}</th>
                    <td>{{ $department['name'] or '' }}</td>
                    <td>{{ $department['province_name'] or '' }}</td>
                    <td>{{ $department['city_name'] or '' }}</td>
                    <td>
                        <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#edit{{ $department['id'] or 0 }}">
                            Edit
                        </button>
                        <div class="modal fade" id="edit{{ $department['id'] or 0 }}" tabindex="-1" role="dialog" aria-labelledby="edit{{ $department['id'] or 0 }}Title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                @include('admin.department.edit')
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $department['id'] or 0 }}">
                            Delete
                        </button>
                        <div class="modal fade" id="delete{{ $department['id'] or 0 }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $department['id'] or 0 }}Title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                @include('admin.department.delete')
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
