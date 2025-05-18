<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🌤️ Subscribe to Weather Updates</title>
    <style>
        body {
            background-color: #ffffff;
            font-family: sans-serif;
            padding: 40px;
            margin: 0;
        }
        .form-container {
            max-width: 500px;
            margin: auto;

            background-color: #ffffff;
            padding: 20px 20px 40px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        h2 {
            text-align: center;
            color: #222;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .subtitle {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
        }
        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
            background-color: #ffffff;
        }
        .error {
            color: #d33;
            font-size: 13px;
            margin-top: -12px;
            margin-bottom: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #3182ce;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .success-message {
            color: #28a745;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>📬 Subscribe</h2>
    <p class="subtitle">🌦️ Get weather updates for your city by email</p>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('weather.subscribe') }}" method="POST">
        @csrf

        <label for="email">📧 Email Address</label>
        <input style="width: 95%" type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="city">🏙️ City</label>
        <input style="width: 95%" type="text" id="city" name="city" value="{{ old('city') }}" required>
        @error('city')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="frequency">⏱️ Update Frequency</label>
        <select id="frequency" name="frequency" required>
            <option value="">-- Select Frequency --</option>
            <option value="hourly" {{ old('frequency') === 'hourly' ? 'selected' : '' }}>Every hour 🌡️</option>
            <option value="daily" {{ old('frequency') === 'daily' ? 'selected' : '' }}>Once a day ☀️</option>
        </select>
        @error('frequency')
        <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">📬 Subscribe</button>
    </form>
</div>

</body>
</html>
