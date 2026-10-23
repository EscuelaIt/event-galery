import { LitElement, css, html } from 'lit';
import type { AxiosInstance } from 'axios';
import '@dile/ui/components/card/card.js';
import '@dile/ui/components/button/button.js';
import '@dile/ui/components/spinner/spinner.js';
import '@dile/ui/components/info-box/info-box.js';
import { list } from '@/routes/galleries';

declare global {
    interface Window {
        axios: AxiosInstance;
    }

    interface HTMLElementTagNameMap {
        'gallery-list': GalleryList;
    }
}

type GalleryListItem = {
    uuid: string;
    name: string;
    location: string | null;
    event_date: string;
    expires_at: string | null;
};

type GalleryListResponse = {
    data: {
        countItems: number;
        result: {
            data: GalleryListItem[];
        };
    };
};

/**
 * Lists the authenticated user's galleries, loading them from the API.
 *
 * @fires gallery-view - Detail: `{ id: string }` with the gallery UUID.
 * @fires gallery-edit - Detail: `{ id: string }` with the gallery UUID.
 */
export class GalleryList extends LitElement {
    static styles = css`
        :host {
            display: block;
            --dile-card-background-color: var(--card);
            --dile-card-text-color: var(--card-foreground);
            --dile-card-border: 1px solid var(--border);
            --dile-card-footer-border-separator: 1px solid var(--border);
            --dile-card-title-font-size: 1.125rem;
            --dile-card-title-font-weight: 600;
            --dile-card-box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --dile-primary-color: var(--primary);
            --dile-on-primary-color: var(--primary-foreground);
            --dile-spinner-color: var(--muted-foreground);
        }
        .grid {
            display: grid;
            gap: 1rem;
        }
        @media (min-width: 768px) {
            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        .location {
            margin: 0 0 0.75rem;
            font-size: 0.875rem;
            color: var(--muted-foreground);
        }
        .dates p {
            margin: 0.25rem 0;
            font-size: 0.875rem;
        }
        .label {
            font-weight: 500;
        }
        .actions {
            display: flex;
            gap: 0.5rem;
        }
        .actions dile-button {
            flex: 1;
        }
        .secondary {
            --dile-button-background-color: var(--background);
            --dile-button-text-color: var(--foreground);
            --dile-button-border-color: var(--border);
            --dile-button-hover-background-color: var(--muted);
            --dile-button-hover-text-color: var(--foreground);
            --dile-button-hover-border-color: var(--border);
        }
        .loading {
            display: flex;
            justify-content: center;
            padding: 3rem 0;
        }
        .empty {
            padding: 3rem 1rem;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            background-color: var(--muted);
            text-align: center;
            color: var(--muted-foreground);
        }
        .empty .title {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 500;
        }
        .empty .subtitle {
            margin: 0.5rem 0 0;
            font-size: 0.875rem;
        }
    `;

    static properties = {
        galleries: { state: true },
        loading: { state: true },
        errorMessage: { state: true },
    };

    declare galleries: GalleryListItem[];
    declare loading: boolean;
    declare errorMessage: string | null;

    constructor() {
        super();
        this.galleries = [];
        this.loading = true;
        this.errorMessage = null;
    }

    connectedCallback(): void {
        super.connectedCallback();
        void this.loadGalleries();
    }

    async loadGalleries(): Promise<void> {
        this.loading = true;
        this.errorMessage = null;

        try {
            const response = await window.axios.get<GalleryListResponse>(
                list.url(),
            );
            this.galleries = response.data.data.result.data;
        } catch {
            this.errorMessage = 'The galleries could not be loaded.';
        } finally {
            this.loading = false;
        }
    }

    render() {
        if (this.loading) {
            return html`<div class="loading">
                <dile-spinner active></dile-spinner>
            </div>`;
        }

        if (this.errorMessage) {
            return html`<dile-info-box isError title="Error">
                ${this.errorMessage}
            </dile-info-box>`;
        }

        if (this.galleries.length === 0) {
            return html`<div class="empty">
                <p class="title">No galleries yet</p>
                <p class="subtitle">Create your first gallery to get started</p>
            </div>`;
        }

        return html`<div class="grid">
            ${this.galleries.map((gallery) => this.galleryTemplate(gallery))}
        </div>`;
    }

    galleryTemplate(gallery: GalleryListItem) {
        return html`<dile-card title=${gallery.name} titleLevel="3">
            ${gallery.location
                ? html`<p class="location">${gallery.location}</p>`
                : ''}
            <div class="dates">
                <p>
                    <span class="label">Event:</span>
                    ${this.formatDate(gallery.event_date)}
                </p>
                ${gallery.expires_at
                    ? html`<p>
                          <span class="label">Expires:</span>
                          ${this.formatDate(gallery.expires_at)}
                      </p>`
                    : ''}
            </div>
            <div class="actions" slot="footer">
                <dile-button
                    @click=${() => this.dispatchGalleryEvent('gallery-view', gallery)}
                >
                    View
                </dile-button>
                <dile-button
                    class="secondary"
                    @click=${() => this.dispatchGalleryEvent('gallery-edit', gallery)}
                >
                    Edit
                </dile-button>
            </div>
        </dile-card>`;
    }

    formatDate(date: string): string {
        return new Date(date).toLocaleDateString('es-ES', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    }

    dispatchGalleryEvent(eventName: string, gallery: GalleryListItem): void {
        this.dispatchEvent(
            new CustomEvent(eventName, {
                bubbles: true,
                composed: true,
                detail: { id: gallery.uuid },
            }),
        );
    }
}

if (!customElements.get('gallery-list')) {
    customElements.define('gallery-list', GalleryList);
}
