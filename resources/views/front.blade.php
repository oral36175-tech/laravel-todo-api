<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Mening API Loyiham</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 font-sans">

    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Tizimga kirish</h2>

        <div id="login-qismi">
            <input type="email" id="email" placeholder="Emailingizni yozing" class="w-full border p-2 mb-3 rounded">
            <input type="password" id="parol" placeholder="Parol" class="w-full border p-2 mb-3 rounded">
            <button onclick="loginQilish()" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                Kirish (Token olish)
            </button>
        </div>

        <div id="vazifalar-qismi" style="display: none;">
            <p class="text-green-600 font-bold mb-3">✅ Muvaffaqiyatli kirdingiz!</p>
            
            <div class="mt-4 mb-6 flex gap-2">
                <input type="text" id="yangi-vazifa-nomi" placeholder="Yangi vazifa..." class="flex-1 border p-2 rounded">
                <button onclick="vazifaQoshish()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Qo'shish</button>
            </div>

            <h3 class="text-xl font-bold mb-2">Vazifalar ro'yxati:</h3>
            <ul id="vazifalar-royxati" class="space-y-2"></ul>
        </div>
    </div>

    <script>
        let meningTokenim = "";

        async function loginQilish() {
            let email = document.getElementById('email').value;
            let parol = document.getElementById('parol').value;

            let javob = await fetch('/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ email: email, password: parol })
            });

            let data = await javob.json();
            if (data.access_token) {
                meningTokenim = data.access_token;
                document.getElementById('login-qismi').style.display = 'none';
                document.getElementById('vazifalar-qismi').style.display = 'block';
                vazifalarniOlish();
            } else {
                alert("Xato: " + (data.message || "Login yoki parol xato!"));
            }
        }

        async function vazifalarniOlish() {
            let javob = await fetch('/api/vazifalar', {
                headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + meningTokenim }
            });
            let json = await javob.json();
            let royxat = document.getElementById('vazifalar-royxati');
            royxat.innerHTML = "";

            json.data.forEach(vazifa => {
                let rang = vazifa.holati === 'Tugallangan' ? 'bg-green-100 line-through' : 'bg-white';
                let li = document.createElement('li');
                // DIQQAT: Pastda backtick (`) ishlatilgan!
                li.className = `flex justify-between items-center p-3 border rounded-lg ${rang} shadow-sm`;
                li.innerHTML = `
                    <span>${vazifa.nomi}</span>
                    <div class="flex gap-2">
                        <button onclick="holatniOzgarshtir(${vazifa.vazifa_id})" class="text-blue-500 font-bold">✓</button>
                        <button onclick="vazifaniOchirish(${vazifa.vazifa_id})" class="text-red-500 font-bold">X</button>
                    </div>
                `;
                royxat.appendChild(li);
            });
        }

        async function vazifaQoshish() {
            let nomi = document.getElementById('yangi-vazifa-nomi').value;
            await fetch('/api/vazifalar', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + meningTokenim 
                },
                body: JSON.stringify({ nomi: nomi })
            });
            document.getElementById('yangi-vazifa-nomi').value = "";
            vazifalarniOlish();
        }

        async function holatniOzgarshtir(id) {
            await fetch(`/api/vazifalar/${id}`, {
                method: 'PATCH',
                headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + meningTokenim }
            });
            vazifalarniOlish();
        }

        async function vazifaniOchirish(id) {
            if(confirm("O'chirilsinmi?")) {
                await fetch(`/api/vazifalar/${id}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + meningTokenim }
                });
                vazifalarniOlish();
            }
        }
    </script>
</body>
</html>