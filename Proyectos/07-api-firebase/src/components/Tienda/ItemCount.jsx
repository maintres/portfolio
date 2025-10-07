import './Styles.css'

const ItemCount = ({cantidad, handleRestar, handleSumar, handleAgregar}) => {

    return (
        <div className='item-count'>
            <div className='contador-controles'>
                <button 
                    className='button-operar'
                    onClick={handleRestar}
                    disabled={cantidad === 1}
                >
                    -
                </button>
                <span className='contador-numero'>{cantidad}</span>
                <button 
                    className='button-operar'
                    onClick={handleSumar}
                    disabled={cantidad === 10}
                >
                    +
                </button>
            </div>
            <button className='agregar-al-carrito' onClick={handleAgregar} >
                Agregar al carrito
            </button>
        </div>
    )
}

export default ItemCount