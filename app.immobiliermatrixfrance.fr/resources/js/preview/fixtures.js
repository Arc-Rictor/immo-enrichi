export const features = [
    'Swimming pool', 'Parking', 'Balcony', 'Garden', 'Stone', 'Renovated/restored',
    'Countryside view', 'Sea views', 'Character', 'Garage', 'En-suite',
].map(name => ({name}));

const owner = {
    id: 42, first_name: 'Test', last_name: 'Seller 1', email: 'seller@example.test',
    type: 'seller', agent: null,
};

const agent = {
    id: 12, name: 'Immo Allie Estate Agency', address_line_one: '10 Rue de la Paix',
    address_line_two: '', city: 'Paris', postcode: '75002', telephone: '+33 1 23 45 67 89',
};

export const listing = {
    id: 101,
    reference: 'IMF-1234567',
    address_line_one: '12 Chemin des Oliviers',
    address_line_two: '',
    city: 'Mougins',
    province: 'Alpes-Maritimes',
    postcode: '06250',
    country: 'France',
    property_type: 'Villa',
    property_size: 248,
    land_size: 1850,
    bedrooms: 4,
    bathrooms: 3,
    asking_price: '1,295,000',
    price: 1295000,
    description: '<p>Spacious property with mature gardens, generous living accommodation and views across the surrounding countryside.</p>',
    specification: '<p>Four bedrooms, three bathrooms, fitted kitchen, reception rooms, terraces and private parking.</p>',
    latitude: '43.6007',
    longitude: '7.0005',
    status: 'published',
    featured: true,
    is_featured: true,
    is_new: true,
    views: 126,
    image_count: 1,
    featured_image: '/images/img1.png',
    media: [{id: 1, original_url: '/images/img1.png'}],
    features,
    user: owner,
    agent,
    user_favourited: false,
    distance: 8.4,
    created_at: '2026-08-20T10:00:00Z',
};

export const secondListing = {
    ...listing,
    id: 102,
    reference: 'IMF-7654321',
    address_line_one: '4 Rue du Château',
    city: 'Gordes',
    province: 'Vaucluse',
    postcode: '84220',
    property_type: 'House',
    bedrooms: 3,
    bathrooms: 2,
    asking_price: '695,000',
    price: 695000,
    property_size: 172,
    land_size: 920,
    featured_image: '',
    media: [],
    image_count: 0,
    is_featured: false,
    user_favourited: true,
    distance: 21.7,
    status: 'draft',
};

export const listingCollection = {data: [listing, secondListing]};

export const propertyStats = [
    {name: 'Sold Properties', current: 0, change: '5%', changeType: 'increase', colour: 'orange'},
    {name: 'Your saved properties', current: 2, change: '10%', changeType: 'increase', colour: 'blue'},
    {name: 'New listings added this week', current: 1, change: '10%', changeType: 'increase', colour: 'purple'},
];

export const users = {data: [
    {id: 1, first_name: 'Test', last_name: 'Seller 1', email: 'seller@example.test', type: 'seller'},
    {id: 2, first_name: 'Test', last_name: 'Agent 1', email: 'agent@example.test', type: 'agent'},
    {id: 3, first_name: 'Test', last_name: 'Buyer 1', email: 'buyer@example.test', type: 'buyer'},
]};

export const listingInterest = [{
    id: 1,
    listing: {reference: listing.reference, address_line_one: listing.address_line_one, city: listing.city, postcode: listing.postcode},
    agent: {name: 'Immo Allie Estate Agency'},
    message: 'I would be interested in representing this property.',
}];
