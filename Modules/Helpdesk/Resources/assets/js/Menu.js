import { faUserGear } from "@fortawesome/free-solid-svg-icons";
import { menuRoute } from "@/utils/menuRoute";

const menuHelpdesk = {
    status: false,
    text: "Centro de Soporte",
    icom: faUserGear,
    route: null,
    permissions: "help_dashboard",
    items: [
        {
            route: menuRoute("help-level.index"),
            status: false,
            text: "Niveles",
            permissions: "help_nivel",
        },
        {
            route: menuRoute("helpdesk_incidents"),
            status: false,
            text: "Banco de Preguntas",
            permissions: "help_incidentes",
        },
        {
            route: menuRoute("help-boards.index"),
            status: false,
            text: "Tableros",
            permissions: "help_tableros",
        },
    ],
};
export default menuHelpdesk;
