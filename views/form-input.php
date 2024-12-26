<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/style.css">

</head>
<body>
    
    <h1>Form Add Pet</h1>
    
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <form action="create_pet_230012.php" method="POST">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="pet_name_230012" id="name" required class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="type" class="form-label">Type</label>
                        <select name="pet_type_230012" id="type" required class="form-select">
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
                                <input type="radio" name="pet_gender_230012" value="Male" required class="form-radio-input" id="male" checked>
                                <label for="male" class="form-radio-label">Male</label>
                            </div>
                            <div class="form-radio">
                                <input type="radio" name="pet_gender_230012" value="Female" required class="form-radio-input" id="female">
                                <label for="female" class="form-radio-label">Female</label>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="pet_age_230012" id="age" required class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="owner" class="form-label">Owner</label>
                        <input type="text" name="pet_owner_230012" id="" required class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="pet_address_230012" id="address" required class="form-control textarea"></textarea>
                    </div>
    
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" name="pet_phone_230012" id="phone" required class="form-control">
                    </div>
    
                    <div class="form-group" style="display:flex; justify-content:flex-end;">
                        <button type="submit" name="save" class="btn btn-success mx-3">SAVE</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>