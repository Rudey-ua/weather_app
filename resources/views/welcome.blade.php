<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscribe to Weather Updates</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555555;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .error {
            color: red;
            font-size: 13px;
            margin-top: -15px;
            margin-bottom: 10px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Subscribe to Weather Updates</h2>

    @if(session('success'))
        <p style="color: green; text-align: center;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('weather.subscribe') }}" method="POST">
        @csrf

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="city">City</label>
        <input type="text" id="city" name="city" value="{{ old('city') }}" required>
        @error('city')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="frequency">Update Frequency</label>
        <select id="frequency" name="frequency" required>
            <option value="">-- Select Frequency --</option>
            <option value="hourly" {{ old('frequency') === 'hourly' ? 'selected' : '' }}>Hourly</option>
            <option value="daily" {{ old('frequency') === 'daily' ? 'selected' : '' }}>Daily</option>
        </select>
        @error('frequency')
        <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Subscribe</button>
    </form>
</div>

</body>
</html>
