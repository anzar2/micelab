import { createBrowserRouter, RouterProvider } from "react-router-dom";
import Button from "./components/atoms/Button";
import { FaGithub } from "react-icons/fa";
import Input from "./components/atoms/Input";
import Select from "./components/atoms/Select";

const router = createBrowserRouter([
    {
        path: "/app",
        children: [
            {
                path: "",
                element: <div className="max-w-300 flex flex-col gap-3">
                    <Button label="Button" />
                    <Button icon={<FaGithub />} label="clear" variant="clear-selected" />
                    <Button label="Clear" variant="clear" />
                    <Button label="Clear" variant="clear-selected" />
                    <Button label="Clear" variant="danger" />
                    <Input placeholder="Hola" label="Label" />
                    <Select label="Opciones" options={[{label: "Hola", value:"hola"}, {label: "Hola2", value:"hola2"}]}  />
                </div>
            }
        ]
    },
])

export default function Router() {
    return <RouterProvider router={router} />
}