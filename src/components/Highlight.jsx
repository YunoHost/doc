import React from 'react'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'; // Import the FontAwesomeIcon component.

export default function Highlight({children, color, no_break}) {
    return (
        <span
            style={{
                backgroundColor: color,
                borderRadius: '4px',
                color: '#fff',
                padding: '0.2rem',
                whiteSpace: no_break ? 'pre' : null
            }}>
        {children}
        </span>
    );
}

// Webadmin buttons

export function HighlightWebAdmin() {
    return <Highlight no_break={true} color="green"><FontAwesomeIcon icon={["fa", "cogs"]}/> Webadmin</Highlight>;
}
export function HighlightApplications() {
    return <Highlight no_break={true} color="#1877F2"><FontAwesomeIcon icon={["fa", "cubes"]}/> Applications</Highlight>;
}
export function HighlightAppInstall() {
    return <Highlight no_break={true} color="green">+ Install</Highlight>;
}
export function HighlightDiagnosis() {
    return <Highlight no_break={true} color="darkgreen"><FontAwesomeIcon icon={["fa", "stethoscope"]}/> Diagnosis</Highlight>;
}

export function HighlightFFDN() {
    return <Highlight no_break={true} color="#3a87ad">FFDN</Highlight>;
}
export function HighlightNonProfit() {
    return <Highlight no_break={true} color="#32b643">Non Profit</Highlight>;
}

export function HighlightCHATONS() {
    return <Highlight no_break={true} color="#f0980c">CHATONS</Highlight>;
}
