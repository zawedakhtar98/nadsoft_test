$(document).ready(function () {
    loadBusinesses();

    //add business listing
    $('#businessListingForm').on('submit', function (e) {
        e.preventDefault();
        $.post('ajax/AddBusinessListing.php', $(this).serialize(), function (res) {
            let obj = JSON.parse(res);
            if (obj.status) {
                $('.errorMessage').html('<p class="text-success">' + obj.message + '</p>');
                setTimeout(() => {
                    $('#SaveBusinessModal').modal('hide');
                    $('#businessListingForm')[0].reset();
                    $('.errorMessage').html('');
                }, 500);
                table.ajax.reload(null, false);

            }
            else {
                $('.errorMessage').html('<p class="text-danger">' + obj.message + '</p>');
            }
        });
    });

    $(document).on('click', '.editListing', function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'post',
            url: 'ajax/getSingleBusiListing.php',
            data: { id: id },
            success: function (res) {
                let obj = JSON.parse(res);
                let html = `
                        <input type="hidden" name="id" value='`+ obj.data.id + `'>
                        <input type="text" name="name" value='`+ obj.data.name + `' class="form-control mb-2" placeholder="Business Name" required>
                        <textarea name="address"  class="form-control mb-2" placeholder="Address" required>`+ obj.data.address + `</textarea>
                        <input type="number" name="phone" value='`+ obj.data.phone + `' class="form-control mb-2" placeholder="Phone" required>
                        <input type="email" name="email" value='`+ obj.data.email + `' class="form-control mb-2" placeholder="Email" required>
                `;
                $('#form-input').html(html);
                setTimeout(() => {
                    $('#updateBusinessModalform').modal('show');
                }, 500)
            }
        })
    });

    //update business listing
    $('#UpdatebusinessListingForm').on('submit', function (e) {
        e.preventDefault();
        $.post('ajax/UpdateBusinessListing.php', $(this).serialize(), function (res) {
            let obj = JSON.parse(res);
            if (obj.status) {
                $('.errorMessage').html('<p class="text-success">' + obj.message + '</p>');
                setTimeout(() => {
                    $('#updateBusinessModalform').modal('hide');
                    $('#UpdatebusinessListingForm')[0].reset();
                    $('.errorMessage').html('');
                }, 500);
                table.ajax.reload(null, false);

            }
            else {
                $('.errorMessage').html('<p class="text-danger">' + obj.message + '</p>');
            }
        });
    });
});
//delete listing
$(document).on('click', '.deleteListing', function () {

    let id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure? want to delete this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete!'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: 'ajax/DeleteBusinessListing.php',
                data: { id: id },
                success: function (res) {
                    let data = JSON.parse(res);

                    if (data.status) {
                        Swal.fire('Deleted!', data.message, 'success');

                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                }
            });

        }
    });
});

var table;
function loadBusinesses() {
    table = $('#businessListing').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "ajax/FetchBusinessListing.php",
            type: "POST"
        }
    });

    $('#businessListing').on('draw.dt', function () {
        $('.rating').raty({
            readOnly: true,
            score: function () {
                return $(this).attr('data-score');
            },
            path: 'assets/js/images'
        });
    });
}

// rating js logic

$(document).on('click', '.rating', function () {
    $('#BusinessRatingModal').modal('show');
    $('#BusinessRatingModal').off('shown.bs.modal').on('shown.bs.modal', function () {
        initRaty();
    });
    let id = $(this).data('id');    
    $('#business_id').val(id);

});

$('#BusinessRatingForm').on('submit', function (e) {
    e.preventDefault();
    $.post('ajax/AddBusinessRating.php', $(this).serialize(), function (res) {
        let obj = JSON.parse(res);
        if (obj.status) {
            setTimeout(() => {
                $('#BusinessRatingModal').modal('hide');
                $('#BusinessRatingForm')[0].reset();
                $('.errorMessage').html('');
            }, 500);
            $('.errorMessage').html('<p class="text-success">' + obj.message + '</p>');
            table.ajax.reload(null, false);

        }
        else {
            Swal.fire( obj.message );
        }
    });
});

function initRaty(score = 0) {
    $('#BusinessRatingModal #starRating').raty({
        score: score,
        half: true,
        click: function (score) {
            $('#rating').val(score);
        },
        path: 'assets/js/images'
    });
    $('#rating').val(score);
}
