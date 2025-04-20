<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('public/css/custom.css' 
    // . generateRandomVersion()
    )}}">
</head>
{{-- @php
    function generateRandomVersion()
    {
        return '?v=' . substr(md5(time()), 0, 8);
    }
@endphp --}}

<body class="register-container">
    <div class="login-box register-box">
        <div class="header">
            <h1>Register</h1>
        </div>
        <form class="login-form" enctype="multipart/form-data">
            <input type="hidden" id="CompanyLogoId" name="CompanyLogoId" value="">

            <!-- Basic Information Section -->
            <div class="basic-information">
                <div class="sub-header">
                    <h3>Basic Information</h3>
                </div>

                <!-- Company Logo Upload -->
                <div class="input-group">
                    <label for="company_logo">Company Logo</label>
                    <div id="imagePreviewContainer" class="image-preview">
                        <div class="main_image_container"></div>
                    </div>
                    <input type="file" name="company_logo" id="company_logo" accept=".png, .webp, .jpeg, .jpg" required />
                </div>

                <div class="input-group-full">
                    <div class="input-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" required />
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required />
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div class="address-information">
                <div class="sub-header">
                    <h3>Address</h3>
                </div>

                
                <div class="input-group-full">
                    <!-- State -->
                    <div class="input-group">
                        <label for="state">State</label>
                        <select name="state" id="state" class="select-input" required>
                            <option value="">Select State</option>
                            @foreach($getStates as $state)
                            <option value="{{ $state->state }}">{{ $state->state }}</option>
                            @endforeach
                        
                        </select>
                        
                    </div>

                    <!-- City -->
                    <div class="input-group">
                        <label for="city">City</label>
                        <select name="city" id="city" class="select-input" required disabled>
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>

                <div class="input-group-full">
                    <div class="input-group">
                        <label for="street_name">Street Name</label>
                        <input type="text" name="street_name" id="street_name" required />
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required />
                        <div class="input-show-hide">
                            <label for="show-hide-btn" class="show-hide-btn-label">
                                <input type="checkbox" id="show-hide-btn">
                                Show password
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="login-button">Register</button>

            <div class="register-link">
                <p>Already have an account? <a href="{{route('login')}}">Login here</a></p>
            </div>

        </form>
    </div>

    <script src="{{asset('public/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('public/js/jquery.matchHeight-min.js')}}"></script>
    <script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
    <script src="{{asset('public/js/custom.js')}}"></script>

    <script>
     
    const showHideBtn = document.getElementById('show-hide-btn');
    const passwordField = document.getElementById('password');
    showHideBtn.addEventListener('change', function () {
        passwordField.type = this.checked ? 'text' : 'password';
    });

     
    $('#state').on('change', function () {
    const stateName = $(this).val();
    const citySelect = $('#city');

    if (stateName) {
        citySelect.prop('disabled', true).empty().append('<option>Loading...</option>');

        $.ajax({
            url: "{{ route('getCitiesByState') }}",  
            method: 'POST',
            data: {
                stateName: stateName,
                "_token": "{{ csrf_token() }}"  
            },
            success: function (response) {
                citySelect.prop('disabled', false).empty();
                if (response.message && response.message === 'No data found') {
                    citySelect.append('<option value="">No data found</option>');
                } else {
                    citySelect.append('<option value="">Select City</option>');
                    response.forEach(city => {
                        citySelect.append(`<option value="${city}">${city}</option>`);
                    });
                }
            },
            error: function () {
                citySelect.prop('disabled', false).empty().append('<option>Error fetching cities</option>');
            }
        });
    } else {
        citySelect.prop('disabled', true).empty().append('<option value="">Select City</option>');
    }
});


    </script>
</body>

</html>
