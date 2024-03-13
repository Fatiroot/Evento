<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Register</title>
</head>
<body>
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
	<div class="relative py-3 sm:max-w-xl sm:mx-auto">
		<div
			class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
		</div>
		<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
			<div class="max-w-md mx-auto">
                <a href="/home" class="scrollto "><img src="img/logo.png" alt="" title=""></a>

				<div>
					<h1 class="text-2xl mt-4 font-semibold">Create acounte</h1>
				</div>
                <form id="registrationForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <div class="divide-y divide-gray-200">
        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
            <div class="relative">
            <input autocomplete="off" id="image" name="image" type="file" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-rose-600" />
                <label for="image" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Profile</label>
            </div>
            <div class="relative">
                <input autocomplete="off" id="name" name="name" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-rose-600" placeholder="Name" />
                <label for="name" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Name</label>
            </div>
            <div class="relative">
                <input autocomplete="off" id="email" name="email" type="email" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-rose-600" placeholder="Email" />
                <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email</label>
            </div>
            <div class="relative">
                <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-rose-600" placeholder="Password" />
                <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
            </div>
            <div class="relative">
                <input autocomplete="off" id="password_confirmation" name="password_confirmation" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-rose-600" placeholder="Confirm Password" />
                <label for="password_confirmation" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Confirm Password</label>
            </div>
            <!-- role -->
            <div class="mb-6">
                <div class="flex items-center mb-2">
                    <input type="radio" id="role_User" name="role" value="1" class="mr-2">
                    <label for="role_User" class="mr-4">User</label>

                    <input type="radio" id="role_Organizer" name="role" value="2" class="mr-2">
                    <label for="role_Organizer">Organizer</label>
                </div>
                <div class="relative">
                    <button class="bg-blue-500 text-white rounded-md px-2 py-1">Register</button>
                    <a type="button" class="bg-blue-500 text-white rounded-md px-2 py-1" href="home">Return to Home</a>
                    <a type="button" class="bg-blue-500 text-white rounded-md px-2 py-1" href="login">Return to login</a>

                </div>
            </div>
        </div>
    </div>
</form>

		</div>
	</div>
</div>


<script src="https://cdn.tailwindcss.com"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('registrationForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            if (validateForm()) {
                form.submit();
            }
        });

        function validateForm() {
            var isValid = true;

            var nameInput = document.getElementById('name');
            var emailInput = document.getElementById('email');
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('password_confirmation');

            // Validate Name
            if (nameInput.value.trim() === '') {
                isValid = false;
                alert('Please enter your name.');
                nameInput.classList.add('border', 'border-red-500');
            } else {
                nameInput.classList.remove('border', 'border-red-500');
            }

            // Validate Email
            if (emailInput.value.trim() === '') {
                isValid = false;
                alert('Please enter your email.');
                emailInput.classList.add('border', 'border-red-500');
            } else {
                emailInput.classList.remove('border', 'border-red-500');
            }

            // Validate Password
            if (passwordInput.value.trim() === '') {
                isValid = false;
                alert('Please enter your password.');
                passwordInput.classList.add('border', 'border-red-500');
            } else {
                passwordInput.classList.remove('border', 'border-red-500');
            }

            // Validate Confirm Password
            if (confirmPasswordInput.value.trim() === '') {
                isValid = false;
                alert('Please confirm your password.');
                confirmPasswordInput.classList.add('border', 'border-red-500');
            } else if (passwordInput.value !== confirmPasswordInput.value) {
                isValid = false;
                alert('Passwords do not match.');
                passwordInput.classList.add('border', 'border-red-500');
                confirmPasswordInput.classList.add('border', 'border-red-500');
            } else {
                passwordInput.classList.remove('border', 'border-red-500');
                confirmPasswordInput.classList.remove('border', 'border-red-500');
            }

            return isValid;
        }
    });
</script>

</body>
</html>
