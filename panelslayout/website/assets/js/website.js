function restrictPastDates() {
    let today = new Date();
    const year = today.getFullYear();
    const month = ('0' + (today.getMonth() + 1)).slice(-2);
    const day = ('0' + today.getDate()).slice(-2);
    today = `${year}-${month}-${day}`;
    $('#start_date').attr('min', today)
    $('#end_date').attr('min', today)
}


function formatDate(dateString) {
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = ('0' + (date.getMonth() + 1)).slice(-2);
    const day = ('0' + date.getDate()).slice(-2);
    return `${day}-${month}-${year}`;
}

function dateValidation() {
    let startingDateInput = $("#start_date").val();
    let endingDateInput = $("#end_date").val();
    if (startingDateInput > endingDateInput) {
        $('#error-message').text("The end date must be a date after or equal to start date.");
        $('button[type="submit"]').prop('disabled', true);
        return false;
    }
    $('#error-message').text("");
    $('button[type="submit"]').prop('disabled', false);
    return true;
}

function isVehicleAvailable(vehicles, vehicleId) {
    for (const key in vehicles) {
        if (vehicles.hasOwnProperty(key)) {
        const vehicle = vehicles[key];

        if (vehicle.vehicle_id == vehicleId) {
            return true;
        }
        }
    }
    return false;
}

function isDriverAvailable(drivers, driverId) {
    for (const key in drivers) {
        if (drivers.hasOwnProperty(key)) {
        const driver = drivers[key];

        if (driver.driver_id == driverId) {
            return true;
        }
        }
    }
    return false;
}

function availabilityCheck(storeUrl, bookingFormData) {
    let startingDate = $("#starting_date").val();
    let endingDate = $("#ending_date").val();
    if (startingDate && endingDate) {
        let formData = new FormData();
        formData.append("starting_date", startingDate);
        formData.append("ending_date", endingDate);
        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
        $('#error-message').text("");
        $.ajax({
            url: "/booking-availability",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.success) {
                    driverId = $('#driver_id').val();
                    vehicleId = $('#vehicle_reg_id').val();
                    if(data.isActive == 0) {
                        $('#error-message').text("You are currently in-active");
                        $('#booking-form-submit-btn').prop('disabled', true);
                        return;
                    }
                    if (!isVehicleAvailable(data.vehicles, vehicleId)) {
                        $('#error-message').text("This car isn't available at the dates you've selected");
                        $('#booking-form-submit-btn').prop('disabled', true);
                        return;
                    }
                    if (!isDriverAvailable(data.drivers, driverId)) {
                        $('#error-message').text("You already have a booking on these dates");
                        $('#booking-form-submit-btn').prop('disabled', true);
                        return;
                    }
                    if (bookingFormData) {
                        storeBooking(storeUrl, bookingFormData)
                    }
                } else {
                    swal.fire("Error", data.message, "error");
                }
            },
        });
    }
}

function storeBooking(storeUrl, bookingFormData) {
    $.ajax({
        url: storeUrl,
        type: 'POST',
        data: bookingFormData,
        _token: $('meta[name="csrf-token"]').attr('content'),
        beforeSend: function() {
            Swal.fire({
                title: 'Please Wait',
                html: 'Processing...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
                customClass: {
                    loader: 'custom-loader'
                }
            });
        },
        success: function(data) {
            if (data.success) {
                window.location.href = `/confirmBooking/${data.booking_id}`;
            } else {
                Swal.fire("Error", data.message, "error");
            }
        },
        error: function(data) {
            if (data.responseJSON && data.responseJSON.errors) {
                const errors = data.responseJSON.errors;
                let errorMessage = '<ol>';
                for (const key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        const errorMessages = errors[key];
                        errorMessages.forEach(message => {
                            errorMessage += `<li>${message}</li>`;
                        });
                    }
                }
                errorMessage += '</ol>';
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: errorMessage,
                });
            } else {
                Swal.fire("Error", "An error occurred", "error");
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function submitBookingForm(storeUrl, confrimURL) {
    $('#bookingForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        let bookingFormData = new FormData(this);
        availabilityCheck(storeUrl, bookingFormData);
    });

    // Manually trigger the form submission
    $('#booking-form').submit();
}


// Drag and Drop Files
function handleDragOver(event) {
    event.preventDefault();
    event.stopPropagation();
    event.currentTarget.classList.add('dragover');
}

function handleDragLeave(event) {
    event.preventDefault();
    event.stopPropagation();
    event.currentTarget.classList.remove('dragover');
}

function handleDrop(event, imgId) {
    event.preventDefault();
    event.stopPropagation();
    event.currentTarget.classList.remove('dragover');
    const files = event.dataTransfer.files;

    if (files.length) {
        document.getElementById(imgId).files = files;
        const changeEvent = new Event('change');
        document.getElementById(imgId).dispatchEvent(changeEvent);
    }
}