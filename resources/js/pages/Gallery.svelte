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

        <div class="flex items-center justify-center rounded-xl border border-sidebar-border/70 bg-muted/30 py-12 dark:border-sidebar-border">
            <div class="text-center">
                <p class="text-lg font-medium text-muted-foreground">
                    This is the gallery management section
                </p>
                <p class="mt-2 text-sm text-muted-foreground">
                    Photo gallery features coming soon...
                </p>
            </div>
        </div>
    </div>
</div>
