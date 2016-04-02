@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Quick Example</h3>
        </div>
        <form role="form" class="form-horizontal" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="title" class="col-sm-1 control-label">Use Case Title</label>

              <div class="col-sm-3">
                <input type="text" class="form-control" id="title" name="title" value="{{ $data->title}}" placeholder="Use Case Title">
              </div>
              <label for="use_id" class="col-sm-1 control-label">Use Case Id</label>

              <div class="col-sm-3">
                <input type="text" class="form-control" name="use_id" id="use_id" value="{{ $data->use_id }}" placeholder="Use Case Id">
              </div>

              <label for="level" class="col-sm-1 control-label">Importance Level</label>

              <div class="col-sm-3">
                <input type="text" class="form-control" id="level" name="level" value="{{ $data->level}}" placeholder="Importance Level">
              </div>
            </div>
            <div class="form-group">
              <label for="actor" class="col-sm-1 control-label">Primary Actor</label>

              <div class="col-sm-5">
                <input type="text" class="form-control" id="actor" name="actor" value="{{ $data->actor}}" placeholder="Primary Actor">
              </div>
              <label for="type" class="col-sm-1 control-label">Use Case Type</label>

              <div class="col-sm-5">
                <input type="text" class="form-control" id="type" name="type" value="{{ $data->type}}" placeholder="Use Case Type">
              </div>
            </div>
            <div class="form-group">
              <label for="stakeholder" class="col-sm-2 control-label">Stakeholders and Interests</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="stakeholder" id="stakeholder" value="{{ $data->stakeholder}}" placeholder="Stakeholders and Interests">
              </div>
            </div>
            <div class="form-group">
              <label for="brief" class="col-sm-2 control-label">Brief Description</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="brief" id="brief" value="{{ $data->brief}}" placeholder="Brief Description">
              </div>
            </div>
            <div class="form-group">
              <label for="trigger" class="col-sm-2 control-label">Trigger</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="trigger" id="trigger" value="{{ $data->trigger}}" placeholder="Trigger">
              </div>
            </div>
            <div class="form-group">
              <label for="type_" class="col-sm-2 control-label">Type</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="type_" name="type_" value="{{ $data->type_}}" placeholder="Type">
              </div>
            </div>
            <div class="form-group">
              <label for="relation" class="col-sm-2 control-label">Relationships</label>

              <div class="col-sm-10">
                <textarea rows="4" class="form-control" id="relation" name="relation" placeholder="Relationships">{{ $data->relation}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="pre_condition" class="col-sm-2 control-label">Pre-Conditions</label>

              <div class="col-sm-10">
                <textarea rows="4" class="form-control" name="pre_condition" id="pre_condition" placeholder="Pre-Conditions">{{ $data->pre_condition}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="post_condition" class="col-sm-2 control-label">Post-Conditions</label>

              <div class="col-sm-10">
                <textarea rows="4" class="form-control" name="post_condition" id="post_condition" placeholder="Post-Conditions">{{ $data->post_condition}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="event_" class="col-sm-2 control-label">Flow of activities</label>

              <div class="col-sm-10">

                  <div class="form-group">
                    <div class="col-sm-6">
                        <p class="text-center">Actor</p>
                        <textarea rows="5"  class="form-control" name="flow_actor" id="flow_actor" placeholder="flow_actor">{{ $data->flow_actor}}</textarea>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-center">System</p>
                        <textarea rows="5"  class="form-control" name="flow_system" id="flow_system" placeholder="flow_system">{{ $data->flow_system}}</textarea>
                    </div>
                  </div>

              </div>
            </div>
            <div class="form-group">
              <label for="exception" class="col-sm-2 control-label">Alternate/Exceptional Flows</label>
              <div class="col-sm-10">
                <textarea rows="5"  class="form-control" name="exception" id="exception" placeholder="Alternate/Exceptional Flows">{{ $data->exception}}</textarea>
              </div>
            </div>
            <div class="box-footer">
              <input type="checkbox" name="status" value="t" placeholder="" {{ $data->status === 0 ? '' : 'checked'}}> เสร็จแล้วติ๊กถูกด้วย (ถ้ายังไม่เสร็จไม่ต้องติ๊ก) 
              <button type="submit" name="save" class="btn btn-info">Save</button>
            </div>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
    <!-- End Main Form -->
</div>
@endsection