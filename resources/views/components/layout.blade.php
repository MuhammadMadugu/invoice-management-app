<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice App</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand">Invoice Manager</div>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="/invoice">View Invoices</a>
            <a href="/invoice/add">Add Invoice</a>
        </div>
    </nav>

    <main class="container">
    @if(session('success'))
    <div id="success-alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        {{ $slot }}
    </main>
 <script>
    // Wait until DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('success-alert');
        if(alert){
            // Wait 4 seconds (4000ms)
            setTimeout(() => {
                alert.classList.add('fade-out');
            }, 4000);
            
            // Remove from DOM after fade-out transition
            alert.addEventListener('transitionend', () => {
                alert.remove();
            });
        }
    });
</script>

</body>
</html>
