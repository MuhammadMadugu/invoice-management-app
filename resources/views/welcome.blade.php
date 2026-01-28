<x-layout>
    <div class="home-container">
        <h1>Invoice Management App</h1>

        <p class="app-description">
            Welcome to the Invoice Management App! This application allows you to easily create, manage, 
            and track your invoices. You can add new invoices, view all invoices, upload related files, 
            and monitor payment statuses—all in one place.
        </p>

        <div class="button-group">
            <a href="{{ route('invoices.index') }}" class="btn-action btn-view">View Invoices</a>
            <a href="{{ route('invoices.create') }}" class="btn-action btn-add">Add Invoice</a>
        </div>
    </div>

    <style>
        .home-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 40px;
            background: #f9f9f9;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
            font-family: 'Arial', sans-serif;
        }

        .home-container h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }

        .app-description {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            cursor: pointer;
            min-width: 140px;
        }

        .btn-view {
            background: linear-gradient(135deg, #4dabf7 0%, #339af0 100%);
            box-shadow: 0 2px 6px rgba(51, 154, 240, 0.2);
        }

        .btn-view:hover {
            background: linear-gradient(135deg, #339af0 0%, #228be6 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(51, 154, 240, 0.3);
        }

        .btn-add {
            background: linear-gradient(135deg, #38b000 0%, #2f9e00 100%);
            box-shadow: 0 2px 6px rgba(56, 176, 0, 0.2);
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #2f9e00 0%, #228800 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(56, 176, 0, 0.3);
        }

        @media (max-width: 600px) {
            .button-group {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</x-layout>
