<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Animated Stars Background</title>
    <link rel="stylesheet" href="../../css/backgroundAnimated.css">

    <style>
        body {
            background-image: url('../../assets/backgroundLogin.png');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            background: rgba(74, 74, 74, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(85, 85, 85, 0.3);
            z-index: 9999;
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            filter: blur(8px);
            z-index: -1;
            margin: -20px;
        }

        .logo-section {
            text-align: center;
            width: 50%;
        }

        .logo-ornament {
            color: #d4af37;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .logo-title {
            color: #fff;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 5px;
        }

        .logo-subtitle {
            color: #d4af37;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .login-title {
            color: #d4af37;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #3a3a3a;
            border: 1px solid #555;
            border-radius: 8px;
            color: #fff;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #4a4a4a;
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            color: #fff;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .login-btn {
            background: linear-gradient(145deg, #d4af37, #b8941f);
            border: none;
            border-radius: 8px;
            color: #000;
            font-weight: bold;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .login-btn:hover {
            background: linear-gradient(145deg, #b8941f, #d4af37);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .lock-icon {
            margin-right: 8px;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 20px;
            }
        }
    </style>

    <style>
        .signup-container {
            background: rgba(74, 74, 74, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px 35px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 10;
            position: relative;
            overflow: hidden;
            min-height: 550px;
        }

        /* .signup-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #d4af37, transparent, #d4af37);
            border-radius: 25px;
            z-index: -1;
            animation: borderGlow 3s ease-in-out infinite alternate;
        }

        @keyframes borderGlow {
            0% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        } */

        .logo-section {
            text-align: center;
        }

        .logo-title {
            color: #fff;
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 5px;
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.5);
        }

        .logo-subtitle {
            color: #d4af37;
            font-size: 14px;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        /* Stepper Styles */
        .stepper {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin-bottom: 40px;
            position: relative;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            transition: all 0.4s ease;
            border: 3px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        .step-circle.active {
            background: #1a1a1a;
            color: #d4af37;
        }

        .step-circle.completed {
            background: linear-gradient(145deg, #28a745, #20c997);
            border-color: #28a745;
            color: #fff;
            box-shadow: 0 0 15px rgba(40, 167, 69, 0.4);
        }

        .step-label {
            margin-top: 10px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
        }

        .step.active .step-label {
            color: #d4af37;
            font-weight: bold;
        }

        .step.completed .step-label {
            color: #28a745;
        }

        .step-connector {
            position: absolute;
            top: 25px;
            left: 50%;
            right: 50%;
            height: 3px;
            background: rgba(255, 255, 255, 0.2);
            z-index: 1;
            transition: all 0.4s ease;
        }

        .step-connector.completed {
            background: linear-gradient(90deg, #28a745, #20c997);
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.4);
        }

        .step:first-child .step-connector {
            display: none;
        }

        /* Form Styles */
        .step-content {
            position: relative;
            min-height: 280px;
        }

        .form-step {
            position: absolute;
            width: 100%;
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
        }

        .form-step.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: all;
        }

        .form-step.prev {
            transform: translateX(-50px);
        }

        .step-title {
            color: #d4af37;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 2px;
            text-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: #fff;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: #d4af37;
            box-shadow: 0 0 0 0.3rem rgba(212, 175, 55, 0.25);
            color: #fff;
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
            font-weight: 300;
        }

        .btn-group-costume {
            display: flex;
             justify-content: space-between;
            margin-top: 30px;
            gap: 15px;
        }

        .btn-custom {
            border: none;
            border-radius: 12px;
            font-weight: bold;
            padding: 15px 25px;
            font-size: 16px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            flex: 1;
        }

        .btn-next,
        .btn-signup {
            background: linear-gradient(145deg, #d4af37, #b8941f);
            color: #000;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        }

        .btn-next:hover,
        .btn-signup:hover {
            background: linear-gradient(145deg, #b8941f, #d4af37);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        .btn-prev {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-prev:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .btn-custom:active {
            transform: translateY(0);
        }

        .btn-icon {
            margin-inline : 8px;
        }

        /* Progress indicator */
        .progress-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0 0 25px 25px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #d4af37, #b8941f);
            transition: width 0.5s ease;
            width: 33.33%;
        }

        @media (max-width: 480px) {
            .signup-container {
                margin: 20px;
                padding: 30px 25px;
                max-width: none;
            }

            .step-circle {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .step-label {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-0 border-0 bg-transparent d-flex justify-content-center align-items-center ">
                <div class="d-flex justify-content-center align-items-center min-vh-100 p-3">
                    <div class="signup-container">
                        <!-- Logo Section -->
                       <div class="d-flex flex-column align-items-center m-0 p-0">
                        <img src="../../assets/logo.png" alt="logo" class="img-fluid logo-section m-0">
                    </div>

                        <!-- Stepper -->
                        <div class="stepper">
                            <div class="step active" data-step="1">
                                <div class="step-circle active">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="step-label">Personal Info</div>
                            </div>
                            <div class="step-connector"></div>
                            <div class="step" data-step="2">
                                <div class="step-circle">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                <div class="step-label">Contact Details</div>
                            </div>
                            <div class="step-connector"></div>
                            <div class="step" data-step="3">
                                <div class="step-circle">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="step-label">Security</div>
                            </div>
                        </div>

                        <!-- Form Steps -->
                        <div class="step-content">
                            <!-- Step 1: Personal Info -->
                            <div class="form-step active" id="step1">
                                <h3 class="step-title">Personal Information</h3>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Full Name" id="fullName" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email Address" id="email" required>
                                    </div>
                                    <div class=" btn-group-costume">
                                        <button type="button" class="btn-custom btn-next" onclick="nextStep()">
                                            Continue<i class="fas fa-arrow-right btn-icon"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Step 2: Contact Details -->
                            <div class="form-step" id="step2">
                                <h3 class="step-title">Contact Details</h3>
                                <form>
                                    <div class="form-group">
                                        <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Address" id="address" required>
                                    </div>
                                    <div class="btn-group-costume">
                                        <button type="button" class="btn-custom btn-prev" onclick="prevStep()">
                                            <i class="fas fa-arrow-left btn-icon"></i>Back
                                        </button>
                                        <button type="button" class="btn-custom btn-next" onclick="nextStep()">
                                            Continue<i class="fas fa-arrow-right btn-icon"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Step 3: Security -->
                            <div class="form-step" id="step3">
                                <h3 class="step-title">Security</h3>
                                <form>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password" id="confirmPassword" required>
                                    </div>
                                    <div class="btn-group-costume">
                                        <button type="button" class="btn-custom btn-prev" onclick="prevStep()">
                                            <i class="fas fa-arrow-left btn-icon"></i>Back
                                        </button>
                                        <button type="button" class="btn-custom btn-signup" onclick="submitForm()">
                                            Sign Up<i class="fas fa-user-plus btn-icon"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress-container">
                            <div class="progress-bar" id="progressBar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="../../js/signin.js"></script>
<script src="../../js/backgroundAnimated.js"></script>

</html>



<script>
    let currentStep = 1;
    const totalSteps = 3;

    function updateStepper() {
        // Update step indicators
        document.querySelectorAll('.step').forEach((step, index) => {
            const stepNum = index + 1;
            const stepElement = step.querySelector('.step-circle');

            step.classList.remove('active', 'completed');
            stepElement.classList.remove('active', 'completed');

            if (stepNum < currentStep) {
                step.classList.add('completed');
                stepElement.classList.add('completed');
                stepElement.innerHTML = '<i class="fas fa-check"></i>';
            } else if (stepNum === currentStep) {
                step.classList.add('active');
                stepElement.classList.add('active');
                if (stepNum === 1) stepElement.innerHTML = '<i class="fas fa-user"></i>';
                else if (stepNum === 2) stepElement.innerHTML = '<i class="fas fa-address-card"></i>';
                else stepElement.innerHTML = '<i class="fas fa-lock"></i>';
            } else {
                if (stepNum === 1) stepElement.innerHTML = '<i class="fas fa-user"></i>';
                else if (stepNum === 2) stepElement.innerHTML = '<i class="fas fa-address-card"></i>';
                else stepElement.innerHTML = '<i class="fas fa-lock"></i>';
            }
        });

        // Update connectors
        document.querySelectorAll('.step-connector').forEach((connector, index) => {
            const stepNum = index + 2; // connectors start from step 2
            if (stepNum <= currentStep) {
                connector.classList.add('completed');
            } else {
                connector.classList.remove('completed');
            }
        });

        // Update progress bar
        const progressWidth = (currentStep / totalSteps) * 100;
        document.getElementById('progressBar').style.width = progressWidth + '%';
    }

    function showStep(stepNum) {
        // Hide all steps
        document.querySelectorAll('.form-step').forEach(step => {
            step.classList.remove('active', 'prev');
            if (step.id === `step${stepNum}`) {
                step.classList.add('active');
            } else {
                const stepIndex = parseInt(step.id.replace('step', ''));
                if (stepIndex < stepNum) {
                    step.classList.add('prev');
                }
            }
        });
    }

    function nextStep() {
        if (currentStep < totalSteps) {
            // Validate current step
            if (validateCurrentStep()) {
                currentStep++;
                showStep(currentStep);
                updateStepper();
            }
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
            updateStepper();
        }
    }

    function validateCurrentStep() {
        const currentStepElement = document.getElementById(`step${currentStep}`);
        const inputs = currentStepElement.querySelectorAll('input[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.style.borderColor = '#dc3545';
                input.style.boxShadow = '0 0 0 0.3rem rgba(220, 53, 69, 0.25)';
                isValid = false;

                // Reset border after 3 seconds
                setTimeout(() => {
                    input.style.borderColor = '';
                    input.style.boxShadow = '';
                }, 3000);
            } else {
                input.style.borderColor = '';
                input.style.boxShadow = '';
            }
        });

        // Additional validation for step 3 (password confirmation)
        if (currentStep === 3) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                document.getElementById('confirmPassword').style.borderColor = '#dc3545';
                document.getElementById('confirmPassword').style.boxShadow = '0 0 0 0.3rem rgba(220, 53, 69, 0.25)';
                isValid = false;

                setTimeout(() => {
                    document.getElementById('confirmPassword').style.borderColor = '';
                    document.getElementById('confirmPassword').style.boxShadow = '';
                }, 3000);
            }
        }

        return isValid;
    }

    function submitForm() {
        if (validateCurrentStep()) {
            // Collect all form data
            const formData = {
                fullName: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                password: document.getElementById('password').value
            };

            // Show success animation
            const container = document.querySelector('.signup-container');
            container.style.transform = 'scale(1.05)';
            container.style.background = 'rgba(40, 167, 69, 0.2)';

            setTimeout(() => {
                alert('Account created successfully!');
                // Here you would typically send the data to your server
                console.log('Form Data:', formData);

                // Reset form
                resetForm();
            }, 500);
        }
    }

    function resetForm() {
        currentStep = 1;
        showStep(currentStep);
        updateStepper();

        // Clear all inputs
        document.querySelectorAll('input').forEach(input => {
            input.value = '';
            input.style.borderColor = '';
            input.style.boxShadow = '';
        });

        // Reset container style
        const container = document.querySelector('.signup-container');
        container.style.transform = '';
        container.style.background = '';
    }

    // Add input event listeners for real-time validation feedback
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            if (this.style.borderColor === 'rgb(220, 53, 69)') {
                this.style.borderColor = '';
                this.style.boxShadow = '';
            }
        });
    });

    // Initialize
    updateStepper();
</script>