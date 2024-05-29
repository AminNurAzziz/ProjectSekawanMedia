                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $vehicle['VehicleID'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Vehicle</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('vehicles.update', $vehicle['VehicleID']) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="form-group">
                                                        <label for="VehicleModel">Vehicle Model</label>
                                                        <input type="text" class="form-control" id="VehicleModel" name="VehicleModel" value="{{ $vehicle['VehicleModel'] }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="VehicleType">Vehicle Type</label>
                                                        <input type="text" class="form-control" id="VehicleType" name="VehicleType" value="{{ $vehicle['VehicleType'] }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="VehicleStatus">Vehicle Status</label>
                                                        <input type="text" class="form-control" id="VehicleStatus" name="VehicleStatus" value="{{ $vehicle['VehicleStatus'] }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="FuelConsumptionPerKM">Fuel Consumption Per KM</label>
                                                        <input type="number" step="0.01" class="form-control" id="FuelConsumptionPerKM" name="FuelConsumptionPerKM" value="{{ $vehicle['FuelConsumptionPerKM'] }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ServiceIntervalKM">Service Interval KM</label>
                                                        <input type="number" class="form-control" id="ServiceIntervalKM" name="ServiceIntervalKM" value="{{ $vehicle['ServiceIntervalKM'] }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Ownership">Ownership</label>
                                                        <input type="text" class="form-control" id="Ownership" name="Ownership" value="{{ $vehicle['Ownership'] }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
