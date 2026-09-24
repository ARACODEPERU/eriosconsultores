import {
    faBookReader,
    faBook,
    faGripVertical,
    faUserPen,
    faTags,
    faLayerGroup,
    faBuilding,
    faIdCard,
    faGauge,
} from "@fortawesome/free-solid-svg-icons";
// menuRoute() no lanza cuando la ruta no esta en el listado de Ziggy (modulo
// deshabilitado o nombre desincronizado).
import { menuRoute } from "@/utils/menuRoute";

const menuBibliodata = {
    status: false,
    text: "Biblio Data",
    icom: faBookReader,
    route: 'module',
    permissions: "bib_dashboard",
    items: [
        {
            route: menuRoute("bib_dashboard"),
            status: false,
            text: "Dashboard",
            icom: faGauge,
            permissions: "bib_dashboard",
            dashboard: true,
        },
        {
            route: menuRoute("bib_authors"),
            status: false,
            text: "Autores",
            icom: faUserPen,
            permissions: "bib_autores_listar",
        },
        {
            route: menuRoute("bib_categories"),
            status: false,
            text: "Categorías",
            icom: faGripVertical,
            permissions: "bib_categorias_listar",
        },
        {
            route: menuRoute("bib_tags"),
            status: false,
            text: "Tags",
            icom: faTags,
            permissions: "bib_tags_listar",
        },
        {
            route: menuRoute("bib_books"),
            status: false,
            text: "Libros",
            icom: faBook,
            permissions: "bib_libros_listado",
        },
        {
            route: menuRoute("bib_subscription_plans"),
            status: false,
            text: "Planes",
            icom: faLayerGroup,
            permissions: "bib_planes_listar",
        },
        {
            route: menuRoute("bib_organizations"),
            status: false,
            text: "Organizaciones",
            icom: faBuilding,
            permissions: "bib_organizaciones_listar",
        },
        {
            route: menuRoute("bib_subscriptions"),
            status: false,
            text: "Suscripciones",
            icom: faIdCard,
            permissions: "bib_suscripciones_listar",
        },
    ],
};

export default menuBibliodata;
