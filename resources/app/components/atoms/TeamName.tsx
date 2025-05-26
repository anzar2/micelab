import { useEffect, useState } from "react"
import Container from "./Container"
import axios from "axios";
import { FaA, FaBuildingShield, FaGroupArrowsRotate, FaM, FaUserGroup } from "react-icons/fa6";
import { BiBuildingHouse, BiBuildings } from "react-icons/bi";
import { FaBootstrap, FaBuilding } from "react-icons/fa";

interface Team {
    id: number;
    team_name: string;
}

function TeamName() {

    const [team, setTeam] = useState<Team>();

    useEffect(() => {
        const getTeam = async () => {
            let response = await axios.get("/api/teams")
            let team: Team = response.data;
            setTeam(team)
        }
        getTeam()
    }, [])



    return <Container background>
        <span className="flex  text-gray  items-center gap-2 p-1 px-3 font-semibold select-none">
            {team ?
                <>
                    <FaGroupArrowsRotate />
                    {team?.team_name}
                </>
                :
                "Loading"
            }
        </span>
    </Container>
}

export default TeamName
