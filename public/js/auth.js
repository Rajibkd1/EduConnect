// Panel switching
const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.querySelector(".auth-container");

if (signUpButton) {
    signUpButton.addEventListener("click", () => {
        container.classList.add("right-panel-active");
    });
}

if (signInButton) {
    signInButton.addEventListener("click", () => {
        container.classList.remove("right-panel-active");
    });
}

// Mobile toggle functionality
const mobileSignUpButton = document.getElementById("mobileSignUp");
if (mobileSignUpButton) {
    mobileSignUpButton.addEventListener("click", () => {
        container.classList.add("right-panel-active");
    });
}

// Signup flow steps
const emailStep = document.getElementById("email-step");
const otpStep = document.getElementById("otp-step");
const registrationStep = document.getElementById("registration-step");

// Step navigation
const backToEmailBtn = document.getElementById("back-to-email");
const backToOtpBtn = document.getElementById("back-to-otp");

if (backToEmailBtn) {
    backToEmailBtn.addEventListener("click", () => {
        otpStep.classList.add("hidden");
        emailStep.classList.remove("hidden");
    });
}

if (backToOtpBtn) {
    backToOtpBtn.addEventListener("click", () => {
        registrationStep.classList.add("hidden");
        otpStep.classList.remove("hidden");
    });
}

// Message display function
function showMessage(elementId, message, isSuccess = true) {
    const messageDiv = document.getElementById(elementId);
    if (messageDiv) {
        messageDiv.textContent = message;
        messageDiv.className = `message ${isSuccess ? "success" : "error"}`;
        messageDiv.classList.remove("hidden");
    }
}

// Get CSRF token
function getCSRFToken() {
    const metaToken = document.querySelector('meta[name="csrf-token"]');
    return metaToken ? metaToken.getAttribute("content") : "";
}

// Email form submission
const emailForm = document.getElementById("email-form");
if (emailForm) {
    emailForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const email = document.getElementById("email").value;

        try {
            const response = await fetch("/signup/send-otp", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": getCSRFToken(),
                },
                body: JSON.stringify({ email }),
            });

            const data = await response.json();

            if (data.success) {
                showMessage("message", data.message);
                setTimeout(() => {
                    emailStep.classList.add("hidden");
                    otpStep.classList.remove("hidden");
                }, 1000);
            } else {
                showMessage("message", data.message, false);
            }
        } catch (error) {
            showMessage(
                "message",
                "An error occurred. Please try again.",
                false
            );
        }
    });
}

// OTP form submission
const otpForm = document.getElementById("otp-form");
if (otpForm) {
    otpForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const email = document.getElementById("email").value;
        const otp = document.getElementById("otp").value;

        try {
            const response = await fetch("/signup/verify-otp", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": getCSRFToken(),
                },
                body: JSON.stringify({ email, otp }),
            });

            const data = await response.json();

            if (data.success) {
                showMessage("otp-message", data.message);
                document.getElementById("verified-email").value = email;
                setTimeout(() => {
                    otpStep.classList.add("hidden");
                    registrationStep.classList.remove("hidden");
                }, 1000);
            } else {
                showMessage("otp-message", data.message, false);
            }
        } catch (error) {
            showMessage(
                "otp-message",
                "An error occurred. Please try again.",
                false
            );
        }
    });
}

// Registration form submission
const registrationForm = document.getElementById("registration-form");
if (registrationForm) {
    registrationForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const response = await fetch("/signup", {
                method: "POST",
                body: formData,
            });

            const data = await response.json();

            if (data.success) {
                showMessage("registration-message", data.message);
                setTimeout(() => {
                    window.location.href = "/dashboard";
                }, 2000);
            } else {
                showMessage("registration-message", data.message, false);
            }
        } catch (error) {
            showMessage(
                "registration-message",
                "An error occurred. Please try again.",
                false
            );
        }
    });
}

// Login form submission
const loginForm = document.getElementById("login-form");
if (loginForm) {
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const response = await fetch("/login", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": getCSRFToken(),
                },
                body: formData,
            });

            const data = await response.json();

            if (data.success) {
                showMessage("login-message", data.message);
                setTimeout(() => {
                    window.location.href = data.redirect || "/dashboard";
                }, 1500);
            } else {
                showMessage("login-message", data.message, false);
            }
        } catch (error) {
            showMessage(
                "login-message",
                "An error occurred. Please try again.",
                false
            );
        }
    });
}

// Password toggle functionality
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + "-icon");

    if (passwordField && icon) {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            // Eye slash icon (hidden)
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
            `;
        } else {
            passwordField.type = "password";
            // Eye icon (visible)
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            `;
        }
    }
}

// OTP input enhancements
const otpInput = document.getElementById("otp");
if (otpInput) {
    otpInput.addEventListener("input", function (e) {
        // Only allow numbers
        this.value = this.value.replace(/[^0-9]/g, "");

        // Auto-submit when 6 digits are entered
        if (this.value.length === 6) {
            setTimeout(() => {
                if (otpForm) {
                    otpForm.dispatchEvent(new Event("submit"));
                }
            }, 500);
        }
    });

    // Add paste functionality for OTP
    otpInput.addEventListener("paste", function (e) {
        e.preventDefault();
        const paste = (e.clipboardData || window.clipboardData).getData("text");
        const numbers = paste.replace(/[^0-9]/g, "").substring(0, 6);
        this.value = numbers;

        if (numbers.length === 6) {
            setTimeout(() => {
                if (otpForm) {
                    otpForm.dispatchEvent(new Event("submit"));
                }
            }, 500);
        }
    });
}

// Make togglePassword function globally available
window.togglePassword = togglePassword;
