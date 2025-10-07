import '../../../stylesheets/ItemListContainer.css'

export const Usuario=({nombre, correo, rol}) => {
    
    return (
        <div className='itemListContainer'>
            <h1>Usuario</h1>
            <p>Nombre: <span>{nombre}</span></p>
            <p>Correo: <span>{correo}</span></p>
            <p>Rol: <span>{rol}</span></p>
            
        </div>
    )
}