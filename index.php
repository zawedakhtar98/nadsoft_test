<?php require('layout/header.php'); ?>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h1 class="m-0">&nbsp;</h1>
                <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#SaveBusinessModal">Add Business</button>
            </div>

            <table class="table table-bordered bg-white shadow-sm" id="businessListing">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Business Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="businessTableBody"></tbody>
            </table>
        </div>
        <div class="modal fade" id="SaveBusinessModal" tabindex="-1">
            <div class="modal-dialog">
                <form id="businessListingForm" class="modal-content">
                    <input type="hidden" name="action" value="save_business">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Business Listing</h5>
                    </div>
                    <div class="modal-body">
                        <div class="errorMessage">

                        </div>
                        <input type="text" name="name" class="form-control mb-2" placeholder="Business Name" required>
                        <textarea name="address" class="form-control mb-2" placeholder="Address" required></textarea>
                        <input type="number" name="phone" class="form-control mb-2" placeholder="Phone" required>
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="updateBusinessModalform" tabindex="-1">
            <div class="modal-dialog">
                <form id="UpdatebusinessListingForm" class="modal-content">
                    <input type="hidden" name="action" value="update_business">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title text-center">Update Business Listing</h5>
                    </div>
                    <div class="modal-body">
                        <div class="errorMessage">
                        </div>
                        <div id="form-input"></div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="BusinessRatingModal" tabindex="-1">
            <div class="modal-dialog">
                <form id="BusinessRatingForm" class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title text-center">Business Rating</h5>
                        <input type="hidden" name="action" value="submit_rating">
                    </div>
                    <div class="modal-body">
                        <div class="errorMessage">
                        </div>                        
                        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                        <input type="number" name="phone" class="form-control mb-2" placeholder="Phone" required>
                       <div id="starRating"></div>
                        <input type="hidden" name="business_id" id="business_id">
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php require('layout/footer.php'); ?>