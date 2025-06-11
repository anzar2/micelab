export const APP_VERSION = document.querySelector('meta[name="app-version"]')?.getAttribute("content") ?? "NO VERSION PROVIDED";
export const TEAM_NAME = document.querySelector('meta[name="team-name"]')?.getAttribute("content") ?? "UNKNOWN TEAM";
export const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");