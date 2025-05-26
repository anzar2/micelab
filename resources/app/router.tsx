import { createBrowserRouter, RouterProvider } from "react-router-dom";
import Button from "./components/atoms/Button";
import { FaGithub } from "react-icons/fa";
import Sidebar from "./components/organisms/Sidebar";
import Layout from "./components/templates/Layout";
import Container from "./components/atoms/Container";
import Navbar from "./components/molecules/Navbar";

const router = createBrowserRouter([
    {
        path: "/app",
        children: [
            {
                path: "",
                element: <Layout />
            }
        ]
    },
])

export default function Router() {
    return <RouterProvider router={router} />
}