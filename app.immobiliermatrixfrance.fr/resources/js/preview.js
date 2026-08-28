import './bootstrap';
import '../css/preview.css';
import {createApp, h, reactive} from 'vue';
import {page, router, setPageProps} from './preview/inertia.js';
import translations from '../lang/fr/fr.json';
import {features, listing, listingCollection, listingInterest, propertyStats, secondListing, users} from './preview/fixtures.js';

import Login from './Pages/Auth/Login.vue';
import Register from './Pages/Auth/Register.vue';
import ForgotPassword from './Pages/Auth/ForgotPassword.vue';
import ResetPassword from './Pages/Auth/ResetPassword.vue';
import ConfirmPassword from './Pages/Auth/ConfirmPassword.vue';
import TwoFactorChallenge from './Pages/Auth/TwoFactorChallenge.vue';
import VerifyEmail from './Pages/Auth/VerifyEmail.vue';
import AgentRegistrationProfile from './Pages/Auth/AgentRegistrationProfile.vue';
import Dashboard from './Pages/Dashboard/Dashboard.vue';
import SearchIndex from './Pages/Search/SearchIndex.vue';
import ListingIndex from './Pages/Listing/ListingIndex.vue';
import ListingShow from './Pages/Listing/ListingShow.vue';
import ListingCreate from './Pages/Listing/ListingCreate.vue';
import ListingEdit from './Pages/Listing/ListingEdit.vue';
import ListingAvailableIndex from './Pages/Listing/ListingAvailableIndex.vue';
import ListingAgentInterestIndex from './Pages/Listing/ListingAgentInterestIndex.vue';
import Profile from './Pages/Profile/Show.vue';
import UserIndex from './Pages/Admin/Users/UserIndex.vue';
import ApiTokens from './Pages/API/Index.vue';
import PrivacyPolicy from './Pages/PrivacyPolicy.vue';
import TermsOfService from './Pages/TermsOfService.vue';

const routeNames = {
    login: 'login', register: 'register', 'password.request': 'forgot-password',
    'password.reset': 'reset-password', 'password.confirm': 'confirm-password',
    'verification.notice': 'verify-email', 'two-factor.login': 'two-factor',
    'register.agent': 'agent-registration', dashboard: 'dashboard',
    'property-search': 'search', 'listing.index': 'listings', 'listing.create': 'create',
    'listing.show': 'property', 'listing.edit': 'edit', 'listing.agent-interest': 'agent-interest',
    'admin.users.index': 'users', 'profile.show': 'profile', 'api-tokens.index': 'api-tokens',
    logout: 'login', 'locale.update': 'dashboard', billing: 'profile',
};

let currentRouteName = 'login';
globalThis.route = window.route = (name, params) => {
    if (!name) {
        return {current(pattern) {
            if (!pattern) return currentRouteName;
            if (pattern.endsWith('.*')) return currentRouteName.startsWith(pattern.slice(0, -1));
            return currentRouteName === pattern;
        }};
    }
    if (name === 'register' && params?.type) {
        return `${window.location.pathname}?type=${params.type}#register`;
    }
    if (name === 'locale.update') return `#${currentHash()}?locale=${params}`;
    return `#${routeNames[name] || currentHash()}`;
};

window.axios = window.axios || {
    get: () => Promise.resolve({data: {}}),
    post: () => Promise.resolve({data: {redirect_to: '#dashboard'}}),
    delete: () => Promise.resolve({data: {}}),
};

const baseUser = {
    id: 1, first_name: 'Test', last_name: 'Agent', name: 'Test Agent',
    email: 'agent@example.test', telephone: '+33 1 23 45 67 89', type: 'agent',
    agent_id: 12, profile_photo_url: null, two_factor_enabled: false,
};

function currentHash() {
    return (window.location.hash.slice(1).split('?')[0] || 'login');
}

let currentLocale = localStorage.getItem('previewLocale') || 'fr';
window.__setPreviewLocale = locale => {
    currentLocale = locale === 'en' ? 'en' : 'fr';
    localStorage.setItem('previewLocale', currentLocale);
    document.documentElement.lang = currentLocale;
};

function shared(user = baseUser) {
    return {
        user,
        auth: {user},
        can_list: user.type !== 'buyer',
        locale: currentLocale,
        language: currentLocale === 'en' ? {} : translations,
        features: {data: features},
        title: '',
        flash: {message: null},
        errors: {},
        jetstream: {
            flash: {}, canUpdateProfileInformation: true, canUpdatePassword: true,
            canManageTwoFactorAuthentication: true, hasAccountDeletionFeatures: true,
            hasApiFeatures: true, managesProfilePhotos: false,
        },
    };
}

const pages = {
    login: {name: 'login', component: Login},
    register: {name: 'register', component: Register},
    'forgot-password': {name: 'password.request', component: ForgotPassword, props: {status: null}},
    'reset-password': {name: 'password.reset', component: ResetPassword, props: {email: 'agent@example.test', token: 'preview-token'}},
    'confirm-password': {name: 'password.confirm', component: ConfirmPassword},
    'two-factor': {name: 'two-factor.login', component: TwoFactorChallenge},
    'verify-email': {name: 'verification.notice', component: VerifyEmail, props: {status: null}},
    'agent-registration': {name: 'register.agent', component: AgentRegistrationProfile, props: {user: baseUser}},
    dashboard: {name: 'dashboard', component: Dashboard, props: {property_stats: propertyStats, recently_viewed: listingCollection, favourite_properties: {data: [secondListing]}, unpublished_listings_count: 1, available_count: 2}},
    search: {name: 'property-search', component: SearchIndex, props: {listings: listingCollection, filters: {features: features.map(x => x.name)}, searchData: {}, location: null}},
    listings: {name: 'listing.index', component: ListingIndex, props: {listings: listingCollection, availableListings: {data: [secondListing]}, listingInterest}},
    property: {name: 'listing.show', component: ListingShow, props: {listing: {data: listing}, similar_listings: {data: [secondListing]}}},
    create: {name: 'listing.create', component: ListingCreate, props: {features: {data: features}}},
    edit: {name: 'listing.edit', component: ListingEdit, props: {listing: {data: listing}, features: {data: features}}},
    available: {name: 'listing.available', component: ListingAvailableIndex, props: {listings: {data: [secondListing]}}},
    'agent-interest': {name: 'listing.agent-interest', component: ListingAgentInterestIndex, props: {listing: {data: listing}, agents: []}},
    profile: {name: 'profile.show', component: Profile, props: {confirmsTwoFactorAuthentication: false, sessions: [{agent: {is_desktop: true, platform: 'Windows', browser: 'Chrome'}, ip_address: '127.0.0.1', is_current_device: true, last_active: 'Active now'}]}},
    users: {name: 'admin.users.index', component: UserIndex, props: {users}, user: {...baseUser, type: 'admin', first_name: 'Admin'}},
    'api-tokens': {name: 'api-tokens.index', component: ApiTokens, props: {tokens: [], availablePermissions: ['create', 'read', 'update', 'delete'], defaultPermissions: ['read']}},
    privacy: {name: 'privacy-policy', component: PrivacyPolicy},
    terms: {name: 'terms-of-service', component: TermsOfService},
};

const state = reactive({view: null});

function loadPage() {
    const hashLocale = window.location.hash.match(/locale=(en|fr)/)?.[1];
    if (hashLocale) window.__setPreviewLocale(hashLocale);
    const definition = pages[currentHash()] || pages.dashboard;
    currentRouteName = definition.name;
    const user = definition.user || baseUser;
    const props = {...shared(user), ...(definition.props || {})};
    props.title = definition.name === 'listing.show' ? listing.title : '';
    setPageProps(props);
    state.view = {component: definition.component, props: definition.props || {}};
    window.scrollTo(0, 0);
}

const preview = createApp({
    setup() {
        return () => state.view ? h(state.view.component, state.view.props) : null;
    },
});

preview.config.globalProperties.$page = page;
preview.config.globalProperties.$inertia = router;
preview.config.globalProperties.route = window.route;
preview.mount('#app');

window.addEventListener('hashchange', loadPage);
loadPage();
