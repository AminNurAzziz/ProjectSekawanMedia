                                <!-- Detail Modal -->
                                <div class="modal fade" id="vehicleModal{{ $vehicle['VehicleID'] }}" tabindex="-1" role="dialog" aria-labelledby="vehicleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="vehicleModalLabel">Vehicle Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Vehicle ID:</strong> {{ $vehicle['VehicleID'] }}</p>
                                                <p><strong>Vehicle Model:</strong> {{ $vehicle['VehicleModel'] }}</p>
                                                <p><strong>Vehicle Type:</strong> {{ $vehicle['VehicleType'] }}</p>
                                                <p><strong>Vehicle Status:</strong> {{ $vehicle['VehicleStatus'] }}</p>
                                                <p><strong>Fuel Consumption Per KM:</strong> {{ $vehicle['FuelConsumptionPerKM'] }}</p>
                                                <p><strong>Service Interval KM:</strong> {{ $vehicle['ServiceIntervalKM'] }}</p>
                                                <P><strong>Last BBM:</strong> {{ $vehicle['LastBBM'] }}</p>
                                                <P><strong>Last KM:</strong> {{ $vehicle['LastKM'] }}</p>
                                                <P><strong>KM Need Service</strong> {{ $vehicle['KM_Need_Service'] }}</p>
                                                <p><strong>Ownership:</strong> {{ $vehicle['Ownership'] }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
