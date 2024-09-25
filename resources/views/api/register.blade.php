<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/buds.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Register Form</h2>
        <form id="registerForm">
            <div class="form-group">
                <input type="text" class="form-control" id="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ name, email, password }),
                });

                if (!response.ok) {
                    throw new Error('Registration failed');
                }

                const data = await response.json();
                console.log('Registration successful:', data.message); 


                window.location.href = '{{ url("/login") }}';

            } catch (error) {
                console.error('Registration failed:', error.message);
                alert('Registration failed: ' + error.message);
            }
        });
    </script>

</body>

</html>
