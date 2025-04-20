<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('public/css/custom.css' . generateRandomVersion())}}">
</head>
@php
    function generateRandomVersion()
    {
        return '?v=' . substr(md5(time()), 0, 8);
    }
@endphp
<style>
     .drop-zone {
        width: 100%;
        max-width: 180px;
        height: 150px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        cursor: pointer;
        background-color: #f9f9f9;
        transition: border 0.3s ease-in-out;
    }

    .drop-zone:hover {
        border-color: #2464C5;
    }

    .drop-zone img {
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
    }

    .drop-zone p {
        font-size: 14px;
        color: #555;
    }

    input[type="file"] {
        display: none;
    }
</style>
<body>
    <div class="overlay"></div>
    <div class="acoda-spinner">
        <img src="{{asset('public/images/rounded_loader.svg')}}" alt="loader gif" class="rounded_loader">
    </div>
    <div class="register-container">
    <div class="login-box register-box">
        <div class="header">
            <h1>Register</h1>
        </div>
         <form action="{{route('register.post')}}" method="post" class="login-form" onsubmit="return checkForm();">
            @csrf
            <input type="hidden" id="CompanyLogoId" name="CompanyLogoId" value="">
            <!-- Basic Information Section -->
            <div class="basic-information">
                <div class="sub-header">
                    <h3>Basic Information</h3>
                </div>

                <!-- Company Logo Upload -->
                <div class="input-group">
                    <!-- Dummy Preview -->
                    <div id="imagePreviewContainer" class="image-preview">
                    <div id="main_image_container" class="main_image_container">
                    </div>
                    </div>
                </div>

                <div class="input-group">
                    <p>Company Logo</p>
                    <label for="company_logo">
                        <div class="drop-zone">
                            <img src="{{asset('public/images/upload_img1.svg')}}" alt="Upload">
                            <p>Click to Upload</p>
                    </div>
                    <input type="file" name="company_logo" id="company_logo" accept=".png, .webp, .jpeg, .jpg" />
                   </label>
                </div>

                <div class="input-group-full">
                <!-- Name -->
                    <div class="input-group">
                    <label for="name">Name<span class="mandatory">*</span></label>
                    <input type="text" name="name" id="name" class="required_fields" data-error-msg="Name is required"/>
                    <span class="scrollForReq error-message"></span>

                </div>
                <!-- Mobile -->
                 <div class="input-group">
                        <label for="mobile">Mobile<span class="mandatory">*</span></label>
                        <input type="text" name="mobile" id="mobile" class="required_fields phone_validation" data-error-msg="Mobile is required"/>
                        <span class="scrollForReq error-message"></span>
                </div>
            </div>

                <div class="input-group-full">
                    <!-- Company Name -->
                    <div class="input-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" />
                    </div>

                    <!-- Email -->
                    <div class="input-group">
                        <label for="email">Email<span class="mandatory">*</span></label>
                        <input type="text" name="email" id="email" class="required_fields email_validation" data-error-msg="Email is required"/>
                        <span class="scrollForReq error-message"></span>
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
                        <select name="state" id="state" class="select-input">
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
                    <!-- Street Name -->
                    <div class="input-group">
                        <label for="street_name">Street Name</label>
                        <input type="text" name="street_name" id="street_name" />
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label for="password">Password<span class="mandatory">*</span></label>
                        <input type="password" name="password" id="password" class="required_fields" data-error-msg="Password is required" autocomplete="new-password"/>
                        <span class="scrollForReq error-message"></span>

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

            <!-- Login Link -->
            <div class="register-link">
                <p>Already have an account? <a href="{{route('login')}}">Login here</a></p>
            </div>

         </form>
    </div>
   </div>

    <!-- Scripts -->
    <script src="{{asset('public/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('public/js/jquery.matchHeight-min.js')}}"></script>
    <script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
    <script src="{{asset('public/js/custom.js')}}"></script>
    <script>
        const showHideBtn = document.getElementById('show-hide-btn');
        const passwordField = document.getElementById('password');

        showHideBtn.addEventListener('change', function () {
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });

        // upload artwork image start

        var fileTypesBusLicense = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp', 'WEBP'];
        
        $("#company_logo").on('change', function(e) {
            if ($(this).val() != '') {
                var that = this;
                if (this.files && this.files[0]) {
                    var fsize = this.files[0].size;
                    const file = Math.round((fsize / 1024));
                    if (file >= 10240) {
                        Swal.fire({
                        title: 'Image size is too big, please upload less then 10MB size',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: '',
                            title: '',
                            actions: '',
                        },

                        }).then(response => {
                        if (!response.ok) {
                        }
                        return response.json();
                    });
                    }
                    var extension = this.files[0].name.split('.').pop().toLowerCase(),
                    isSuccess = fileTypesBusLicense.indexOf(extension) > -1;
                    if (isSuccess) {
                        upload(this, extension);
                    } else {
                        Swal.fire({
                            title: 'Invalid file format, only upload (JPG, JPEG, PNG, WEBP) formats',
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: '',
                                title: '',
                                actions: '',
                            },

                        }).then(response => {
                        if (!response.ok) {
                        }
                        return response.json();
                    });
                    }
                }
                e.target.value='';
            }
        });

        function upload(img, extension) {
            var form_data = new FormData();
            form_data.append('photo', img.files[0]);
            form_data.append('_token', '{{ csrf_token() }}');
            $('.overlay').addClass('active');
            $('body').addClass('overlay_section');
            $(".acoda-spinner").css("display", "inline-flex");

            jQuery.ajax({
                url: "{{route("company.logo.upload")}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function(data) {
                if (!data.errors) {
                $('#imagePreviewContainer').show();
                $('.preiview_container').remove();

                $("#imagePreview").attr('src', '');
                $("#CompanyLogoId").val('');
                $("#CompanyLogoId").val(data.imageId);
                $("#imagePreview").attr('src', data.miniImageUrl);

                $('#main_image_container').append(
                '<div class="preiview_container">' +
                    '<div class="image_preiview_container">' +
                    '<img id="imagePreview" src="'+data.miniImageUrl+'" alt="Uploaded Logo" />' +
                '</div>' +
                 '<div class="remove_image_container">' +
                      '<button type="button" id="removeImage">Remove</button>' +
                '</div>'+
                '</div>'
                );
                }
                 else {
                    Swal.fire({
                        title: 'File format not supported. Please upload a PNG, JPG or WEBP file',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: '',
                            title: '',
                            actions: '',
                        },
                    }).then((result) => {
                      if (result.isConfirmed) {
                        }
                    });
                  }
                },
                complete: function(data) {
                    $("#imagePreview").attr('src', data.miniImageUrl);
                    $('#imagePreview').on('load', function() {
                        $('.overlay').removeClass('active');
                        $('body').removeClass('overlay_section');
                        $(".acoda-spinner").css("display", "none");
                    });
                },
                error: function(xhr, status, error) {
                console.log('error',error.message);
             }
         });
        }
   
         $('body').on('click', '#removeImage', function () {
            $("#imagePreview").attr('src', '');
            $("#CompanyImageId").val('');
            $('#imagePreviewContainer').hide();
            $('.preiview_container').remove();
      });
    // upload artwork image end

  
    // Validate form start 
    function checkForm() {
    $('.overlay').addClass('active');
    $('body').addClass('overlay_section');
    $(".acoda-spinner").css("display", "inline-flex");

    let hasErrors = false;
    let firstErrorElement = null;

    $(".required_fields").each(function () {
        let $this = $(this);
        let value = $this.val().trim();
        let errorMessage = $this.data("error-msg");
        let errorContainer = $this.closest('.input-group').find('.error-message');

        if (!value) {
            hasErrors = true;
            if (!firstErrorElement) {
                firstErrorElement = $this;
            }
            errorContainer.html(errorMessage);
        } else {
            errorContainer.empty();
        }

        // Mobile number validation (if applicable)
        if ($this.hasClass('phone_validation')) {
            let inputValue = $this.val().trim();
            if (!inputValue) {
                hasErrors = true;
                errorContainer.html("Mobile number is required");
            } else if (inputValue.length < 10) {
                hasErrors = true;
                errorContainer.show().html("Mobile number must be at least 10 digits");
            } else {
                errorContainer.empty();
            }
        }

       // Email validation (if applicable)
        if ($this.hasClass('email_validation')) {
            let inputValue = $this.val().trim();
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Standard email validation pattern

            if (!inputValue) {
                hasErrors = true;
                errorContainer.text("Email is required").show();
            } else if (!emailPattern.test(inputValue)) {
                hasErrors = true;
                errorContainer.text("Enter a valid email address").show();
            } else {
                errorContainer.hide();
            }
        }

    });

    if (hasErrors) {
        hideLoader();
        Swal.fire({
            title: 'Please fill all required fields',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            if (firstErrorElement) {
                $("html, body").animate({
                    scrollTop: firstErrorElement.offset().top - 150
                }, 500);
            }
        });
        return false;
    }

    console.log('Validation successful!');
    return true;
}

// Validate form end 
function hideLoader() {
    $('.overlay').removeClass('active');
    $('body').removeClass('overlay_section');
    $(".acoda-spinner").css("display", "none");
}

$('.required_fields').on('keyup', function () {
    let $inputGroup = $(this).closest('.input-group');
    let errorMessage = $inputGroup.find('.error-message');
    let errorIcon = $inputGroup.find('.error');

    if (!$(this).val().trim()) {
        errorMessage.text($(this).data("error-msg")).show();
        errorIcon.hide();
    } else {
        errorMessage.hide();
        errorIcon.hide();
    }
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