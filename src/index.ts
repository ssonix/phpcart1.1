import { Server } from "@modelcontextprotocol/sdk/server/index.js";
import { StdioServerTransport } from "@modelcontextprotocol/sdk/server/stdio.js";
import {
  CallToolRequestSchema,
  ListToolsRequestSchema,
} from "@modelcontextprotocol/sdk/types.js";
import axios, { AxiosInstance } from "axios";

const PLAUD_API_BASE = "https://api.plaud.ai/v1";

function createClient(): AxiosInstance {
  const apiKey = process.env.PLAUD_API_KEY;
  if (!apiKey) throw new Error("PLAUD_API_KEY environment variable is not set");
  return axios.create({
    baseURL: PLAUD_API_BASE,
    headers: {
      Authorization: `Bearer ${apiKey}`,
      "Content-Type": "application/json",
    },
  });
}

const server = new Server(
  { name: "plaud-mcp-server", version: "1.0.0" },
  { capabilities: { tools: {} } }
);

server.setRequestHandler(ListToolsRequestSchema, async () => ({
  tools: [
    {
      name: "list_recordings",
      description: "List recordings from your Plaud device",
      inputSchema: {
        type: "object",
        properties: {
          limit: { type: "number", description: "Max results (default: 20)" },
          offset: { type: "number", description: "Pagination offset (default: 0)" },
        },
      },
    },
    {
      name: "get_transcript",
      description: "Get the full transcript of a recording",
      inputSchema: {
        type: "object",
        properties: {
          recording_id: { type: "string", description: "Recording ID" },
        },
        required: ["recording_id"],
      },
    },
    {
      name: "get_summary",
      description: "Get AI-generated summary and notes for a recording",
      inputSchema: {
        type: "object",
        properties: {
          recording_id: { type: "string", description: "Recording ID" },
        },
        required: ["recording_id"],
      },
    },
    {
      name: "search_recordings",
      description: "Search recordings by keyword in transcripts or titles",
      inputSchema: {
        type: "object",
        properties: {
          query: { type: "string", description: "Search query" },
          limit: { type: "number", description: "Max results (default: 10)" },
        },
        required: ["query"],
      },
    },
  ],
}));

server.setRequestHandler(CallToolRequestSchema, async (request) => {
  let client: AxiosInstance;
  try {
    client = createClient();
  } catch (e: any) {
    return { content: [{ type: "text", text: `Error: ${e.message}` }], isError: true };
  }

  const args = request.params.arguments as Record<string, unknown>;

  try {
    switch (request.params.name) {
      case "list_recordings": {
        const { limit = 20, offset = 0 } = args;
        const res = await client.get("/recordings", { params: { limit, offset } });
        return { content: [{ type: "text", text: JSON.stringify(res.data, null, 2) }] };
      }
      case "get_transcript": {
        const res = await client.get(`/recordings/${args.recording_id}/transcript`);
        return { content: [{ type: "text", text: JSON.stringify(res.data, null, 2) }] };
      }
      case "get_summary": {
        const res = await client.get(`/recordings/${args.recording_id}/summary`);
        return { content: [{ type: "text", text: JSON.stringify(res.data, null, 2) }] };
      }
      case "search_recordings": {
        const { query, limit = 10 } = args;
        const res = await client.get("/recordings/search", { params: { q: query, limit } });
        return { content: [{ type: "text", text: JSON.stringify(res.data, null, 2) }] };
      }
      default:
        return { content: [{ type: "text", text: `Unknown tool: ${request.params.name}` }], isError: true };
    }
  } catch (error: any) {
    return {
      content: [{ type: "text", text: `API error: ${error.response?.data?.message ?? error.message}` }],
      isError: true,
    };
  }
});

const transport = new StdioServerTransport();
await server.connect(transport);
