<!-- Edit BBM Modal -->
<div class="modal fade" id="bbmEditModal{{ $vehicle['VehicleID'] }}" tabindex="-1" role="dialog" aria-labelledby="bbmEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="bbmEditModalLabel">Edit BBM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- Your BBM edit form goes here -->
              <!-- Example form fields -->
              <form method="POST" action="/add-bbm/{{ $vehicle['VehicleID'] }}">
                  @csrf
                  @method('PATCH')
                  <div class="form-group">
                      <label for="BBMField">Add BBM</label>
                      <input type="text" class="form-control" id="BBMField" name="BBMField" value="{{ $vehicle['BBMField'] }}" required>
                  </div>
                  <!-- Add more fields as needed -->
                  <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
          </div>
      </div>
  </div>
</div>
