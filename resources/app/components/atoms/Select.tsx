interface Props {
    options?: { label: string, value: string }[]
    defaultValue?: string,
    label?: string,
    name?: string,
    id?: string
}

function Select(props: Props) {
    const { options, defaultValue, label, name, id } = props


    if (label) {
        return <fieldset>
            <label htmlFor={name}>{label}</label>
            <select id={id} className={`select`} defaultValue={defaultValue} onChange={(e) => { e.target.blur() }}>
                {
                    options?.map((option, index) => {
                        return <option key={index} value={option.value}>{option.label}</option>
                    })
                }
            </select>
        </fieldset>
    }

    return <select className={`select`} defaultValue={defaultValue} onChange={(e) => { e.target.blur() }}>
        {
            options?.map((option, index) => {
                return <option key={index} value={option.value}>{option.label}</option>
            })
        }
    </select>
}

export default Select