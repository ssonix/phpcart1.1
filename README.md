# plaud-mcp-server

MCP server for [Plaud](https://plaud.ai) AI recorder. Gives Claude, Cursor, ChatGPT and other AI tools direct access to your recordings, transcripts, notes and summaries.

## Setup

### 1. Install dependencies

```bash
npm install
```

### 2. Build

```bash
npm run build
```

### 3. Get your Plaud API key

Follow the [Plaud MCP documentation](https://plaud.ai) to obtain your API key.

## Configure in Claude Desktop

Add to `~/Library/Application Support/Claude/claude_desktop_config.json` (macOS) or `%APPDATA%\Claude\claude_desktop_config.json` (Windows):

```json
{
  "mcpServers": {
    "plaud": {
      "command": "node",
      "args": ["/absolute/path/to/plaud-mcp-server/dist/index.js"],
      "env": {
        "PLAUD_API_KEY": "your_api_key_here"
      }
    }
  }
}
```

## Configure in Cursor / other MCP clients

```json
{
  "mcpServers": {
    "plaud": {
      "command": "node",
      "args": ["/absolute/path/to/plaud-mcp-server/dist/index.js"],
      "env": { "PLAUD_API_KEY": "your_api_key_here" }
    }
  }
}
```

## Available tools

| Tool | Description |
|------|-------------|
| `list_recordings` | List all recordings (supports pagination) |
| `get_transcript` | Get full transcript of a recording by ID |
| `get_summary` | Get AI-generated summary and notes by recording ID |
| `search_recordings` | Search recordings by keyword in transcripts/titles |

## Environment variables

| Variable | Required | Description |
|----------|----------|-------------|
| `PLAUD_API_KEY` | Yes | Your Plaud API key |
