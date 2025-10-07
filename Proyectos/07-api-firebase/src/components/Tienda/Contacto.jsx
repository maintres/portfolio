import './Styles.css'
import { useForm } from 'react-hook-form';
const Contacto = () => {

    const { register, handleSubmit } = useForm();
    const onSubmit = (data) => {
        console.log(data);
    }
    return (
        <div className='container'>
            <h1 className='mail-title'>Contacto</h1>
            <form className='formulario' onSubmit={handleSubmit(onSubmit)}>
                <input type="text" placeholder='Nombre' {...register("nombre")} />
                <input type="email" placeholder='Email' {...register("email")} />
                <textarea placeholder='Mensaje' {...register("mensaje")} />
                <button type='submit'>Enviar</button>
            </form>
        </div>
    )
}
export default Contacto
