// Preview personas.
//
// PERSONAS is every perspective the preview can render. ACTIVE_PERSONAS is the
// subset the client can actually select; the rest are shown with the
// application's "Coming Soon" treatment and report that they are not available
// yet. Only estate agent accounts are live at this stage; admin is kept
// selectable so the administrative screens can still be reviewed.
export const PERSONAS = ['buyer', 'seller', 'agent', 'admin'];
export const ACTIVE_PERSONAS = ['agent', 'admin'];

export const DEFAULT_PERSONA = 'agent';
