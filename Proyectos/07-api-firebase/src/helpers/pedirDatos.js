import data from '../data/productos.json'

export const pedirDatos = () => {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(data);
        }, 1000);
    });
}
export const pedirItemById = (id) => {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(data.find((producto) => producto.id === id))
        }, 1000);
    });
}

