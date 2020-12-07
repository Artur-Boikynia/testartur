<form class="form-signin">
    <img class="mb-1" src="../../assets/brand/2020-12-07%2015-45-50.svg" alt="" width="350" height="200" >
    <h1 class="h3 mb-5 font-weight-normal" style="text-align: center">Registration</h1>

    <div class="form-group row">
            <input type="email" class="form-control" id="validationDefault01"   placeholder="Enter your email" required>
    </div>

    <div class="form-group row">
        <input type="text" class="form-control" id="validationDefault01"   placeholder="Enter your name" required>
    </div>

    <div class="form-group row">
        <input type="text" class="form-control" id="validationDefault01"   placeholder="Enter your surname" required>
    </div>

    <div class="form-group row">
            <select class="custom-select" id="validationDefault04" required>
                <option selected disabled value="">Choose faculty</option>
                <option>...</option>
            </select>
    </div>

    <div class="form-group row">
        <select class="custom-select" id="validationDefault04" required>
            <option selected disabled value="">Choose group</option>
            <option>...</option>
        </select>
    </div>

    <div class="form-group row">
        <input type="text" class="form-control" id="validationDefault01"   placeholder="Enter your password" required>
    </div>

    <div class="form-group row">
        <input type="text" class="form-control" id="validationDefault01"   placeholder="Repeat your password" required>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Teacher
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                        Student
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Registration</button>
    <a class="btn btn-lg btn-primary btn-block mt-3" href="/login/login">Sign in</a>
    <label for="registration">If you have account, you can sign in!</label>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
