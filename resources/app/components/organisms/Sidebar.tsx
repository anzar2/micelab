import Container from "../atoms/Container"
import TeamName from "../atoms/TeamName";

interface SidebarProps {
    children?: any
    className?: string;
}

function Sidebar(props: SidebarProps) {
    const {
        children,
        className
    } = props

    return <Container className={`w-50  overflow-hidden flex flex-col gap-1 ${className}`}>
        <TeamName></TeamName>
        <Container className="grow" background>
            {children}
        </Container>
    </Container>
}

export default Sidebar
