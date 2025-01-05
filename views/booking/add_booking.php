<?php

include '../components/head.php';

?>

<h1>Form Add</h1>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form action="create_pet.php" method="POST">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="pet_name" id="name" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="type" class="form-label">Type</label>
                    <select name="pet_type" id="type" required class="form-select">
                        <option value="" selected disabled>Choose</option>
                        <option value="Cat">Cat</option>
                        <option value="Dog">Dog</option>
                        <option value="Bird">Bird</option>
                        <option value="Reptile">Reptile</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gender" class="form-label">Gender</label>
                    <div class="form-radio-container">
                        <div class="form-radio">
                            <input type="radio" name="pet_gender" value="Male" required class="form-radio-input" id="male" checked>
                            <label for="male" class="form-radio-label">Male</label>
                        </div>
                        <div class="form-radio">
                            <input type="radio" name="pet_gender" value="Female" required class="form-radio-input" id="female">
                            <label for="female" class="form-radio-label">Female</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" name="pet_age" id="age" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="owner" class="form-label">Owner</label>
                    <input type="text" name="pet_owner" id="" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="pet_address" id="address" required class="form-control textarea"></textarea>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" name="pet_phone" id="phone" required class="form-control">
                </div>

                <div class="form-group" style="display:flex; justify-content:flex-end;">
                    <button type="submit" name="save" class="btn btn-success mx-3">SAVE</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '../components/footer.php' ?>