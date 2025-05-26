import React from 'react'

interface InputProps {
    type?: "text" | "email" | "number";
    placeholder?: string;
    name?: string;
    label?: string;
    id?: string;
    icon?: React.ReactElement;
}

function Input(props: InputProps) {
    const {
        type,
        placeholder,
        name,
        label = "",
        id,
        icon
    } = props

    const inputMode: Record<"text" | "email" | "number", "text" | "email" | "numeric"> = {
        text: "text",
        email: "email",
        number: "numeric"
    }

    return <fieldset>
        <label htmlFor={name}>{label}</label>
        <div className='input flex items-center gap-3 relative'>
            {icon && <div className='text-gray mt-[1px]'>{icon}</div>}
            <input inputMode={inputMode[type ?? "text"]} className='w-full focus:outline-none' id={id} name={name} type={type} placeholder={placeholder} />
        </div>
    </fieldset>
}

export default Input
