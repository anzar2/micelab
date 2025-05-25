import React from 'react'

export interface ButtonProps {
    label?: string,
    icon?: React.ReactElement
    variant?: "primary" | "clear" | "clear-selected" | "outline" | "danger",
    onClick?: () => {}
}

function Button(props: ButtonProps) {
    const {
        label = "",
        icon,
        variant = "primary",
        onClick = () => { }
    } = props

    return <button onClick={onClick} className={`btn btn-${variant} flex align-center gap-2`}>
        {icon}
        {label}
    </button>
}

export default Button
