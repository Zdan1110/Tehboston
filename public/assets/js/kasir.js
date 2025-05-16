let total = 0;
let count = 0;
let orderHistory = [];

function addToOrder(name, price) {
  const jumlahInput = parseInt(document.getElementById("jumlah-produk")?.value) || 1;
  const orderList = document.getElementById("order-list");
  const existingItem = [...orderList.children].find(li => li.dataset.name === name);

  if (existingItem) {
    const jumlahSpan = existingItem.querySelector(".jumlah");
    const subtotalSpan = existingItem.querySelector(".subtotal");

    let jumlah = parseInt(jumlahSpan.textContent);
    jumlah += jumlahInput;

    jumlahSpan.textContent = jumlah;
    const newSubtotal = price * jumlah;
    subtotalSpan.textContent = `Rp${newSubtotal.toLocaleString("id-ID")}`;

    updateTotalPenjualan();
    updateKembalian();
    return;
  }

  const listItem = document.createElement("li");
  listItem.dataset.name = name;
  listItem.dataset.price = price;

  listItem.innerHTML = `
    <span>${name} x <span class="jumlah">${jumlahInput}</span> - 
    <span class="subtotal">Rp${(price * jumlahInput).toLocaleString("id-ID")}</span></span>
    <button onclick="ubahJumlah(this, 1)">+</button>
    <button onclick="ubahJumlah(this, -1)">–</button>
    <span class="delete" onclick="hapusItem(this)">❌</span>
  `;

  orderList.appendChild(listItem);
  updateTotalPenjualan();
  updateKembalian();
}

function ubahJumlah(button, delta) {
  const listItem = button.closest("li");
  const jumlahSpan = listItem.querySelector(".jumlah");
  const subtotalSpan = listItem.querySelector(".subtotal");
  const price = parseInt(listItem.dataset.price);

  let jumlah = parseInt(jumlahSpan.textContent) + delta;

  if (jumlah <= 0) {
    listItem.remove();
  } else {
    jumlahSpan.textContent = jumlah;
    const newSubtotal = price * jumlah;
    subtotalSpan.textContent = `Rp${newSubtotal.toLocaleString("id-ID")}`;
  }

  updateTotalPenjualan();
  updateKembalian();
}

function hapusItem(span) {
  const listItem = span.closest("li");
  listItem.remove();
  updateTotalPenjualan();
  updateKembalian();
}




function checkoutOrder() {
  const kode = document.getElementById("kode-pelanggan").value.trim();
  const bayar = parseInt(document.getElementById("bayar").value);
  const listItems = document.querySelectorAll("#order-list li");

  if (!kode) return alert("Silakan masukkan nama pelanggan.");
  if (listItems.length === 0) return alert("Tidak ada pesanan.");
  if (isNaN(bayar)) return alert("Masukkan jumlah uang yang dibayar.");
  if (bayar < total) return alert("Uang tidak cukup untuk membayar.");

  const kembalian = bayar - total;
  const kembalianField = document.getElementById("kembalian-input");
  kembalianField.value = `Rp${kembalian.toLocaleString("id-ID")}`;

  const now = new Date();
  let htmlRows = "";

  listItems.forEach(li => {
    const text = li.textContent.replace("❌", "").trim();
    const namaMenu = text.split(" - ")[0];
    const hargaMenu = text.split(" - ")[1];

    htmlRows += `<tr><td>${++count}</td><td>${kode}</td><td>${namaMenu}</td><td>${hargaMenu}</td><td>${now.toLocaleString("id-ID")}</td><td><button class='btn btn-edit' onclick='editRow(this)'>Edit</button><button class='btn btn-delete' onclick='deleteRow(this)'>Hapus</button></td></tr>`;

    orderHistory.push({
      kode,
      menu: namaMenu,
      harga: hargaMenu,
      waktu: now.toISOString()
    });
  });

  document.querySelector("#history-table tbody").insertAdjacentHTML("beforeend", htmlRows);
  document.getElementById("order-list").innerHTML = "";
  total = 0;
  document.getElementById("total").textContent = "Total: Rp0";
  document.getElementById("bayar").value = "";
  kembalianField.value = "";

  saveHistoryToLocalStorage();
  updateTotalPenjualan();
}


function updateKembalian() {
  const bayar = parseInt(document.getElementById("bayar").value) || 0;
  const kembali = bayar - total;
  const kembalianField = document.getElementById("kembalian-input");
  kembalianField.value = kembali >= 0 ? `Rp${kembali.toLocaleString("id-ID")}` : "Rp0";
}

function deleteRow(button) {
  const row = button.closest("tr");
  const menu = row.cells[2].textContent;
  const waktu = row.cells[4].textContent;

  orderHistory = orderHistory.filter(item =>
    !(item.menu === menu && new Date(item.waktu).toLocaleString("id-ID") === waktu)
  );

  saveHistoryToLocalStorage();
  row.remove();
  updateTotalPenjualan();
}

function calculateTotal() {
  let totalBaru = 0;
  document.querySelectorAll("#order-list li").forEach(li => {
    const jumlah = parseInt(li.querySelector(".jumlah").textContent);
    const harga = parseInt(li.dataset.price);
    totalBaru += jumlah * harga;
  });
  return totalBaru;
}


function editRow(button) {
  const row = button.closest("tr");
  const nameCell = row.cells[2];
  const priceCell = row.cells[3];
  const currentName = nameCell.textContent;
  const currentPrice = priceCell.textContent.replace(/[^\d]/g, "");

  nameCell.innerHTML = `<input type='text' value='${currentName}' />`;
  priceCell.innerHTML = `<input type='number' value='${currentPrice}' />`;
  button.textContent = "Simpan";
  button.classList.replace("btn-edit", "btn-save");

  button.onclick = () => {
    const newName = nameCell.querySelector("input").value;
    const newPrice = parseInt(priceCell.querySelector("input").value);
    nameCell.textContent = newName;
    priceCell.textContent = `Rp${newPrice.toLocaleString("id-ID")}`;
    button.textContent = "Edit";
    button.classList.replace("btn-save", "btn-edit");
    button.onclick = () => editRow(button);

    const waktu = row.cells[4].textContent;
    orderHistory = orderHistory.map(item => {
      if (new Date(item.waktu).toLocaleString("id-ID") === waktu) {
        return { ...item, menu: newName, harga: `Rp${newPrice.toLocaleString("id-ID")}` };
      }
      return item;
    });

    saveHistoryToLocalStorage();
    updateTotalPenjualan();
  };
}

function saveHistoryToLocalStorage() {
  localStorage.setItem("orderHistory", JSON.stringify(orderHistory));
}

function loadHistoryFromLocalStorage() {
  const storedHistory = localStorage.getItem("orderHistory");
  if (storedHistory) {
    orderHistory = JSON.parse(storedHistory);
    renderHistoryTable(orderHistory);
    count = orderHistory.length;
  }
}

function renderHistoryTable(data) {
  const tbody = document.querySelector("#history-table tbody");
  tbody.innerHTML = "";
  let no = 1;
  data.forEach(item => {
    tbody.innerHTML += `<tr>
      <td>${no++}</td>
      <td>${item.kode}</td>
      <td>${item.menu}</td>
      <td>${item.harga}</td>
      <td>${new Date(item.waktu).toLocaleString("id-ID")}</td>
      <td>
        <button class='btn btn-edit' onclick='editRow(this)'>Edit</button>
        <button class='btn btn-delete' onclick='deleteRow(this)'>Hapus</button>
      </td>
    </tr>`;
  });
}

function filterHistory() {
  const dateInput = document.getElementById("filter-date").value;
  const filtered = orderHistory.filter(item =>
    !dateInput || item.waktu.startsWith(dateInput)
  );
  renderHistoryTable(filtered);
  updateTotalPenjualan();
}

function updateTotalPenjualan() {
  total = 0;
  document.querySelectorAll("#order-list li").forEach(li => {
    const jumlah = parseInt(li.querySelector(".jumlah").textContent);
    const price = parseInt(li.dataset.price);
    total += jumlah * price;
  });
  document.getElementById("total").textContent = `Total: Rp${total.toLocaleString("id-ID")}`;
}

function cetakPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  const title = "Histori Pembelian - Teh Boston";
  const headers = [["No", "Pelanggan", "Menu", "Harga", "Waktu"]];
  const rows = [];

  let no = 1;
  orderHistory.forEach(item => {
    rows.push([
      no++,
      item.kode,
      item.menu,
      item.harga,
      new Date(item.waktu).toLocaleString("id-ID")
    ]);
  });

  doc.setFontSize(14);
  doc.text(title, 20, 20);

  doc.autoTable({
    startY: 30,
    head: headers,
    body: rows,
    theme: 'striped',
    headStyles: { fillColor: [41, 128, 185] },
  });

  doc.save("histori-pembelian.pdf");
}

window.onload = function () {
  loadHistoryFromLocalStorage();
};

document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname.replace(/\/+$/, "").toLowerCase();

  document.querySelectorAll(".nav-item").forEach(item => {
    const link = item.querySelector("a");
    if (!link) return;

    const linkPath = link.getAttribute("href").replace(/\/+$/, "").toLowerCase();
    if (currentPath === linkPath || currentPath.startsWith(linkPath)) {
      item.classList.add("active");
    } else {
      item.classList.remove("active");
    }
  });
});

window.checkoutOrder = checkoutOrder;
