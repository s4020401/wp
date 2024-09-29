document.getElementById('nav-select').addEventListener('change', function() {
    var value = this.value;
    if (value) {
        window.location.href = value;  // 将页面跳转到选择的 PHP 文件
    }
});

document.querySelector('.select').addEventListener('click', function() {
    var menu = document.querySelector('.menu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
});

document.querySelectorAll('.menu li').forEach(function(item) {
    item.addEventListener('click', function() {
        document.querySelector('.selected').textContent = this.textContent;
        document.getElementById('pet-type').value = this.getAttribute('data-value');
        document.querySelector('.menu').style.display = 'none';
    });
});

document.getElementById('add-pet-form').addEventListener('submit', function(event) {
    event.preventDefault(); // 防止默认表单提交

    // 获取表单数据
    var formData = new FormData(this);

    // 这里可以使用 AJAX 或 Fetch API 来将数据发送到服务器
    fetch('server_endpoint_url', { // 替换为实际的服务器端点
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        // 在这里处理成功的提交，例如显示消息或重定向
    })
    .catch((error) => {
        console.error('Error:', error);
        // 在这里处理错误，例如显示错误消息
    });
});
window.addEventListener("DOMContentLoaded", (event) => {
    // 从 localStorage 获取宠物数据
    let pets = JSON.parse(localStorage.getItem("pets")) || [];

    // 获取表格的 tbody 元素
    let tableBody = document.querySelector("table tbody");

    // 遍历宠物列表并生成表格行
    pets.forEach(pet => {
        let row = document.createElement("tr");

        let nameCell = document.createElement("td");
        nameCell.textContent = pet.name;
        row.appendChild(nameCell);

        let typeCell = document.createElement("td");
        typeCell.textContent = pet.type;
        row.appendChild(typeCell);

        let ageMonthsCell = document.createElement("td");
        ageMonthsCell.textContent = pet.ageMonths;
        row.appendChild(ageMonthsCell);

        let locationCell = document.createElement("td");
        locationCell.textContent = pet.location;
        row.appendChild(locationCell);

        tableBody.appendChild(row);
    });
});



