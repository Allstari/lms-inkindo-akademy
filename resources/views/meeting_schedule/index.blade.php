@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Meeting Schedules</h1>
        <button id="btn-add-schedule" class="btn btn-primary mb-3">Add New Schedule</button>

        <!-- Table to display schedules -->
        <table class="table table-bordered" id="schedule-table">
            <thead>
                <tr>
                    <th>Meeting Name</th>
                    <th>Schedule Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr id="schedule-row-{{ $schedule->id }}">
                        <td>{{ $schedule->meeting->meeting_name }}</td>
                        <td>{{ $schedule->schedule_time }}</td>
                        <td>
                            <button class="btn btn-info btn-edit" data-id="{{ $schedule->id }}">Edit</button>
                            <button class="btn btn-danger btn-delete" data-id="{{ $schedule->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal for Add/Edit Schedule -->
        <div class="modal fade" id="schedule-modal" tabindex="-1" role="dialog" aria-labelledby="schedule-modal-label"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="schedule-modal-label">Add/Edit Meeting Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="schedule-form">
                            @csrf
                            <div class="form-group">
                                <label for="meeting_id">Meeting</label>
                                <select name="meeting_id" id="meeting_id" class="form-control" required>
                                    @foreach ($meetings as $meeting)
                                        <option value="{{ $meeting->id }}">{{ $meeting->meeting_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="schedule_time">Schedule Time</label>
                                <input type="datetime-local" name="schedule_time" id="schedule_time" class="form-control"
                                    required>
                            </div>

                            <input type="hidden" name="schedule_id" id="schedule_id">

                            <button type="submit" id="btn-save-schedule" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Show modal to add new schedule
            $('#btn-add-schedule').click(function() {
                $('#schedule-form')[0].reset();
                $('#schedule-id').val('');
                $('#schedule-modal').modal('show');
            });

            // Handle form submission (add/update schedule)
            $('#schedule-form').submit(function(e) {
                e.preventDefault();

                var scheduleId = $('#schedule_id').val();
                var url = scheduleId ? '/meeting_schedules/' + scheduleId : '/meeting_schedules';
                var method = scheduleId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#schedule-modal').modal('hide');
                            location.reload(); // Reload page to update the table
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            // Edit schedule
            $('.btn-edit').click(function() {
                var scheduleId = $(this).data('id');

                $.get('/meeting_schedules/' + scheduleId, function(response) {
                    if (response.success) {
                        $('#schedule_id').val(response.schedule.id);
                        $('#meeting_id').val(response.schedule.meeting_id);
                        $('#schedule_time').val(response.schedule.schedule_time);
                        $('#schedule-modal').modal('show');
                    } else {
                        alert(response.message);
                    }
                });
            });

            // Delete schedule
            $('.btn-delete').click(function() {
                var scheduleId = $(this).data('id');

                if (confirm('Are you sure you want to delete this schedule?')) {
                    $.ajax({
                        url: '/meeting_schedules/' + scheduleId,
                        method: 'DELETE',
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                $('#schedule-row-' + scheduleId)
                                    .remove(); // Remove row from table
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
