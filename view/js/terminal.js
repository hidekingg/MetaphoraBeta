// Inicializar el mapa centrado en México
const map = L.map('map').setView([23.6345, -102.5528], 5);

// Añadir capa de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Icono personalizado para las sucursales
const branchIcon = L.icon({
    iconUrl: './view/img/Mapa/Map.png',
    iconSize: [32, 32],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32]
});

// Añadir marcadores para cada sucursal
branches.forEach(branch => {
    L.marker(branch.coords, { icon: branchIcon })
        .addTo(map)
        .bindPopup(`
            <h3>${branch.name}</h3>
            <img src="${branch.image}" width="100%">
            <p>${branch.address}</p>
        `);
});

// Ajustar el zoom para mostrar todos los marcadores
setTimeout(() => {
    const group = new L.featureGroup(
        branches.map(b => L.marker(b.coords))
    );
    map.fitBounds(group.getBounds().pad(0.2));
}, 500);