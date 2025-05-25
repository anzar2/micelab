import React from 'react'

interface InputProps {
    type?: "text" | "password" | "number"
    placeholder?: string,
    name?: string,
    label?: string,
    id?: string
}

function Input(props: InputProps) {
    const {
        type = "text",
        placeholder,
        name,
        label,
        id
    } = props

    if (label) {
        return <fieldset>
            <label htmlFor={name}>{label}</label>
            <input className='input' id={id} name={name} type={type} placeholder={placeholder} />
        </fieldset>
    }

    return <input className='input' name={name} type={type} placeholder={placeholder} />
}

export default Input
