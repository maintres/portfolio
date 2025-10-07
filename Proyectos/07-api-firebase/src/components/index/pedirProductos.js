import productos from '../../data/productos.json';

const pedirProductos = () => {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(productos);
        }, 500)
    })
}

export default pedirProductos;
