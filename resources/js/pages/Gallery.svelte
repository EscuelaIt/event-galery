<script module lang="ts">
    import { gallery } from '@/routes';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Gallery',
                href: gallery(),
            },
        ],
    };
</script>

<script lang="ts">
    import AppHead from '@/components/AppHead.svelte';
    import Heading from '@/components/Heading.svelte';
    import { Link } from '@inertiajs/svelte';

    let { galleries = [] } = $props();
</script>

<AppHead title="Gallery" />

<h1 class="sr-only">Gallery</h1>

<div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
    <div class="flex flex-col space-y-6">
        <Heading
            variant="small"
            title="Gallery"
            description="Manage your photo galleries"
        />

        {#if !galleries || galleries.length === 0}
            <div class="flex items-center justify-center rounded-xl border border-sidebar-border/70 bg-muted/30 py-12 dark:border-sidebar-border">
                <div class="text-center">
                    <p class="text-lg font-medium text-muted-foreground">
                        No galleries yet
                    </p>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Create your first gallery to get started
                    </p>
                </div>
            </div>
        {:else}
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                {#each galleries as galleryItem (galleryItem.id)}
                    <div class="rounded-lg border border-sidebar-border/70 bg-card p-4 shadow-sm transition-shadow hover:shadow-md dark:border-sidebar-border">
                        <div class="space-y-3">
                            <div>
                                <h3 class="truncate text-lg font-semibold">
                                    {galleryItem.name}
                                </h3>
                                <p class="text-sm text-muted-foreground">
                                    {galleryItem.location}
                                </p>
                            </div>

                            <div class="space-y-1 text-sm">
                                <p>
                                    <span class="font-medium">Event:</span>
                                    {new Date(galleryItem.event_date).toLocaleDateString('es-ES', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric',
                                    })}
                                </p>
                                {#if galleryItem.expires_at}
                                    <p>
                                        <span class="font-medium">Expires:</span>
                                        {new Date(galleryItem.expires_at).toLocaleDateString('es-ES', {
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric',
                                        })}
                                    </p>
                                {/if}
                            </div>

                            <div class="flex gap-2 pt-2">
                                <Link
                                    href={`/galleries/${galleryItem.id}`}
                                    class="flex-1 rounded bg-primary px-3 py-2 text-center text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90"
                                >
                                    View
                                </Link>
                                <Link
                                    href={`/galleries/${galleryItem.id}/edit`}
                                    class="flex-1 rounded border border-input bg-background px-3 py-2 text-center text-sm font-medium transition-colors hover:bg-accent"
                                >
                                    Edit
                                </Link>
                            </div>
                        </div>
                    </div>
                {/each}
            </div>
        {/if}
    </div>
</div>
